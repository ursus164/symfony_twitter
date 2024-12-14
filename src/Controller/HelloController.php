<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\UserProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    // type declaration for safety
    private array $messages = [
        ['value' => 'Hello', 'created' => '2024/11/12'],
        ['value' => 'Hi', 'created' => '2024/10/12'],
        ['value' => 'Hye', 'created' => '2022/02/12']
    ];

    #[Route('/', name: 'app_index')] // optional param with default value of
    public function index(EntityManagerInterface $entityManager, UserProfileRepository $profiles): Response
    {
        // $user = new User();
        // $user->setEmail('test@example.com');
        // $user->setPassword('123456');
        // user is not directly added to DB, instead, when saving profile it will be added (cascading)
        
        // $profile = new UserProfile();
        // $profile->setUser($user);

        // $entityManager->persist($profile);
        // $entityManager->flush();

        // Find user profile by user ID
        // $userProfile = $profiles->findOneBy(['user' => 8]);

        // if ($userProfile) {
        //     $entityManager -> remove($userProfile);
        //     $entityManager -> flush();
        // }

        

        return $this -> render(
            'hello/index.html.twig',
            ['messages' => $this -> messages]
        );
    }

    #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
    public function showOne(int $id): Response
    {
        return $this->render(
            'hello/show_one.html.twig',
            [
                'message' => $this->messages[$id]
            ]
        );
        // return new Response($this -> messages[$id]);
    }
}
