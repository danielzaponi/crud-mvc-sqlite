<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): void
    {
       $data = [
            'title' => 'Seja bem-vindo'
        ];
        $this->render('home/index', $data);
    }
}