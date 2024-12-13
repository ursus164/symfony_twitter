<?php

namespace App\Controller;

use DateTime;
use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        // dd($posts->findAll()); // drop and die

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
            'posts' => $posts->findAll()
        ]);
    }
    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response
    {
        // dd($posts -> find($id));
        //dd($post); // quick way to get single record - with more complex logic we still have to use repository as in index function

        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/micro-post/add', name: 'app_micro_post_add', priority:2)]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $microPost = new MicroPost();

        // microPost object will be filled with data provided by a form - that's why we pass it to builder

        $form = $this->createFormBuilder($microPost)
            ->add('title')
            ->add('text')
            ->add('submit', SubmitType::class,['label' => 'save'])
            ->getForm();

            // forms by default are being sent ti the same path they were rendered in - so to handle the form submission we will use the same action that renders the form

            $form -> handleRequest($request); // handleRequest method will get the data that is being sent in request and try to match them with fields that this form defines including any validation constraints by default

            if($form -> isSubmitted() && $form -> isValid()) {
                $post = $form -> getData();
                $post -> setCreatedAt(new DateTime());
                $entityManager -> persist($post);
                $entityManager -> flush();

                // Add response flash message
                $this -> addFlash('success', 'Your post was added!');

                // Redirect to different page
                return $this -> redirectToRoute('app_micro_post');
            }
            // dd($post);

        return $this->render(
            'micro_post/add.html.twig',
            ['form' => $form]
        );
    }


    #[Route('/micro-post/{post}/edit', name: 'app_micro_post_edit')]
    public function edit(MicroPost $post, Request $request, EntityManagerInterface $entityManager): Response
    {
    
        $form = $this->createFormBuilder($post)
            ->add('title')
            ->add('text')
            ->add('submit', SubmitType::class,['label' => 'Save'])
            ->getForm();

            $form -> handleRequest($request); 

            if($form -> isSubmitted() && $form -> isValid()) {
                $post = $form -> getData();
                $entityManager -> persist($post);
                $entityManager -> flush();

                // Add response flash message
                $this -> addFlash('success', 'Post was updated!');

                // Redirect to different page
                return $this -> redirectToRoute('app_micro_post');
            }
            // dd($post);

        return $this->render(
            'micro_post/add.html.twig',
            ['form' => $form]
        );
    }
}
