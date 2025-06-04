<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class CustomConfig extends BaseConfig
{
    public array $urls = [
        'home'     => '/home',
        'internacoes' => '/internacoes',
        'users'  => '/users',
    ];
}