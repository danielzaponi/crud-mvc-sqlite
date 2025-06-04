<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Retornar a view principal
        $data = [
            'title' => 'Lista de Usuários',
            'scripts' => [
                'users' // Nome do script JS específico para usuários
            ]
        ];
        $this->render('users/index', $data);
    }
    // Listar usuários com paginação

    // Retornar todos os usuários como JSON
    public function list()  
    {
        // Usa os campos permitidos definidos no Model
        $columns = $this->userModel->getAllowedFields();

        // Adiciona o campo de chave primária no início (geralmente 'id')
        array_unshift($columns, $this->userModel->primaryKey);

        // Cria o builder da tabela
        $builder = $this->userModel->builder();

        // Aplica ordenação padrão pelo ID decrescente
        $builder->orderBy($this->userModel->primaryKey, 'DESC');

        // Retorna a resposta no formato esperado pelo DataTables
        return $this->datatablesResponse($builder, $columns);
    }



    // Retornar um usuário específico como JSON
    public function show($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->response->setJSON(['error' => 'Usuário não encontrado'])->setStatusCode(404);
        }

        return $this->response->setJSON($user);
    }

    // Criar um novo usuário e retornar JSON
    public function create()
    {
        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ];

        $this->userModel->setValidationRules($this->userModel->createRules);

        if (! $this->userModel->insert($data)) {
            return $this->response->setJSON([
                'error' => '❌ Erro ao cadastrar usuário',
                'details' => $this->userModel->errors(),
            ])->setStatusCode(500);
        }

        return $this->response->setJSON(['message' => '✅ Usuário cadastrado com sucesso!']);
    }


    // Atualizar um usuário e retornar JSON
public function update($id)
{
    $user = $this->userModel->find($id);

    if (! $user) {
        return $this->response->setJSON(['error' => 'Usuário não encontrado'])->setStatusCode(404);
    }

    $data = $this->request->getRawInput();

    $updateData = [
        'name'  => $data['name'] ?? $user['name'],
        'email' => $data['email'] ?? $user['email'],
        'phone' => $data['phone'] ?? $user['phone'],
    ];

    // Clonar e ajustar dinamicamente a regra de e-mail com is_unique ignorando o próprio ID
    $this->userModel->setValidationRules($this->userModel->updateRules);

    if (! $this->userModel->update($id, $updateData)) {
        return $this->response->setJSON([
            'error' => '❌ Erro ao atualizar usuário',
            'details' => $this->userModel->errors(),
        ])->setStatusCode(500);
    }

    return $this->response->setJSON(['message' => '✅ Usuário atualizado com sucesso!']);
}



    // Deletar um usuário e retornar JSON
    public function delete($id)
    {
        if ($this->userModel->delete($id)) {
            return $this->response->setJSON(['message' => '✅ Usuário excluído!']);
        }

        return $this->response->setJSON(['error' => '❌ Erro ao excluir usuário'])->setStatusCode(500);
    }
}