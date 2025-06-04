<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InternacoesModel;
use CodeIgniter\HTTP\ResponseInterface;

class InternacoesController extends BaseController
{
    protected $internacaoModel;

    public function __construct()
    {
        $this->internacaoModel = new InternacoesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Internações',
            'scripts' => [
                'internacoes'
            ],
        ];
        $this->render('internacoes/index', $data);
    }

    public function list()
    {
        $columns = $this->internacaoModel->getAllowedFields();
        array_unshift($columns, $this->internacaoModel->primaryKey);

        $builder = $this->internacaoModel->builder();
        $builder->orderBy($this->internacaoModel->primaryKey, 'DESC');

        return $this->datatablesResponse($builder, $columns);
    }

    public function show($id)
    {
        $internacao = $this->internacaoModel->find($id);

        if (! $internacao) {
            return $this->response->setJSON(['error' => 'Internação não encontrada'])->setStatusCode(404);
        }

        return $this->response->setJSON($internacao);
    }

    public function create()
    {
        $data = [
            'data_geracao'    => $this->request->getPost('data_geracao'),
            'regional'        => $this->request->getPost('regional'),
            'uf'              => $this->request->getPost('uf'),
            'unidade'         => $this->request->getPost('unidade'),
            'tipo'            => $this->request->getPost('tipo'),
            'clinica'         => $this->request->getPost('clinica'),
            'convenio'        => $this->request->getPost('convenio'),
            'paciente'        => $this->request->getPost('paciente'),
            'data_nascimento' => $this->request->getPost('data_nascimento'),
            'cpf'             => $this->request->getPost('cpf'),
            'sexo'            => $this->request->getPost('sexo'),
            'numero_atendimento' => $this->request->getPost('numero_atendimento'),
            'apartamento'     => $this->request->getPost('apartamento'),
            'leito'           => $this->request->getPost('leito'),
            'diaria'          => $this->request->getPost('diaria'),
            'data_internacao' => $this->request->getPost('data_internacao'),
        ];

        $this->internacaoModel->setValidationRules($this->internacaoModel->createRules);

        if (! $this->internacaoModel->insert($data)) {
            return $this->response->setJSON([
                'error' => '❌ Erro ao cadastrar internação',
                'details' => $this->internacaoModel->errors(),
            ])->setStatusCode(500);
        }

        return $this->response->setJSON(['message' => '✅ Internação cadastrada com sucesso!']);
    }

    public function update($id)
    {
        $internacao = $this->internacaoModel->find($id);

        if (! $internacao) {
            return $this->response->setJSON(['error' => 'Internação não encontrada'])->setStatusCode(404);
        }

        $data = $this->request->getRawInput();

        $updateData = [
            'data_geracao'    => $data['data_geracao'] ?? $internacao['data_geracao'],
            'regional'        => $data['regional'] ?? $internacao['regional'],
            'uf'              => $data['uf'] ?? $internacao['uf'],
            'unidade'         => $data['unidade'] ?? $internacao['unidade'],
            'tipo'            => $data['tipo'] ?? $internacao['tipo'],
            'clinica'         => $data['clinica'] ?? $internacao['clinica'],
            'convenio'        => $data['convenio'] ?? $internacao['convenio'],
            'paciente'        => $data['paciente'] ?? $internacao['paciente'],
            'data_nascimento' => $data['data_nascimento'] ?? $internacao['data_nascimento'],
            'cpf'             => $data['cpf'] ?? $internacao['cpf'],
            'sexo'            => $data['sexo'] ?? $internacao['sexo'],
            'numero_atendimento' => $data['numero_atendimento'] ?? $internacao['numero_atendimento'],
            'apartamento'     => $data['apartamento'] ?? $internacao['apartamento'],
            'leito'           => $data['leito'] ?? $internacao['leito'],
            'diaria'          => $data['diaria'] ?? $internacao['diaria'],
            'data_internacao' => $data['data_internacao'] ?? $internacao['data_internacao'],
        ];

        $this->internacaoModel->setValidationRules($this->internacaoModel->updateRules);

        if (! $this->internacaoModel->update($id, $updateData)) {
            return $this->response->setJSON([
                'error' => '❌ Erro ao atualizar internação',
                'details' => $this->internacaoModel->errors(),
            ])->setStatusCode(500);
        }

        return $this->response->setJSON(['message' => '✅ Internação atualizada com sucesso!']);
    }

    public function delete($id)
    {
        if ($this->internacaoModel->delete($id)) {
            return $this->response->setJSON(['message' => '✅ Internação excluída!']);
        }

        return $this->response->setJSON(['error' => '❌ Erro ao excluir internação'])->setStatusCode(500);
    }
}