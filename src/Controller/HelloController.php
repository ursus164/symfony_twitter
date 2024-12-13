<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    // type declaration for safety
    private array $messages = [
        'Hello',
        'Hi',
        'Bye'
    ];

    #[Route('/{limit<\d+>?3}', name: 'app_index')] // optional param with default value of
    public function index(int $limit) : Response
    {
        return new Response(implode(',', array_slice($this -> messages,0,$limit))); // joins elements of arrray
    }

    #[Route('/messages/{id<\d+>}', name:'app_show_one')]
    public function showOne(int $id) : Response 
    {
        return new Response($this -> messages[$id]);
    }
}
