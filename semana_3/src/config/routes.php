<?php

use Daoo\Aula03\controller\api\Produto;
use Daoo\Aula03\controller\api\User;
use Daoo\Aula03\controller\api\Postagem;
use Daoo\Aula03\controller\api\Tags;
use Daoo\Aula03\controller\web\Produto as WebProduto;

$routes = [
    'api' => [
        'produtos' => Produto::class,
        'user' => User::class,
        'postagem' => Postagem::class,
        'tags' => Tags::class
    ],
    'web' => [
        'produtos' => WebProduto::class
    ]
];
