<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // dd($posts -> findAll()); // drop and die
        // dd($posts -> find(4)); // drop and die
        // dd($posts -> findOneBy(['title' => 'Welcome to US'])); // only one
        // dd($posts -> findBy(['title' => 'Welcome to US'])); // all records with that title

        // Add new
        // $microPost = new MicroPost();
        // $microPost -> setTitle('It comes from controller');
        // $microPost -> setText('Hi!');
        // $microPost -> setCreatedAt(new DateTime());

        // $entityManager -> persist($microPost); 
        // $entityManager -> flush();
        
        // Edit existing
        // $microPost = $posts -> find(4);
        // $microPost -> setTitle('New title');
    
        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
        ]);
    }
}