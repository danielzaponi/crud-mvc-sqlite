<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];


    protected $navItems = [
        ['name' => 'Início', 'route' => 'home'],
        ['name' => 'Internações', 'route' => 'internacoes'],
        ['name' => 'Usuários', 'route' => 'users']
    ];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');
    }

    protected function render($view, $data = [])
    {
        $data['urls'] = $this->navItems; // inclui os itens da navbar
        echo view('templates/header', $data);
        echo view($view, $data);
        echo view('templates/footer', $data);
    }

    protected function datatablesResponse($builder, $columns)
    {
        $request = $this->request;

        $searchValue = $request->getPost('search')['value'] ?? '';
        $orderColumnIndex = $request->getPost('order')[0]['column'] ?? 0;
        $orderColumn = $columns[$orderColumnIndex] ?? $columns[0];
        $orderDir = $request->getPost('order')[0]['dir'] ?? 'asc';
        $start = $request->getPost('start') ?? 0;
        $length = $request->getPost('length') ?? 10;

        $totalRecords = $builder->countAll();

        // Aplicar filtro
        if (!empty($searchValue)) {
            $builder->groupStart();
            foreach ($columns as $col) {
                $builder->orLike($col, $searchValue);
            }
            $builder->groupEnd();
        }

        $filteredRecords = $builder->countAllResults(false);

        // Ordenar e paginar
        $data = $builder->orderBy($orderColumn, $orderDir)
            ->limit($length, $start)
            ->get()
            ->getResult();

        return $this->response->setJSON([
            'draw' => intval($request->getPost('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ]);
    }
}