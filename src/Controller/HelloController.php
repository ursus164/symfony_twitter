<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use App\Repository\UserProfileRepository;
use DateTime;
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
    public function index(EntityManagerInterface $entityManager, CommentRepository $comments, MicroPostRepository $posts): Response
    {
        // OneToOne -> requires EntityManagerInterface $entityManager, UserProfileRepository $profiles

        // $user = new User();
        // $user->setEmail('test@example.com');
        // $user->setPassword('123456');
        // user is not directly added to DB, instead, when saving profile it will be added (cascading)
        
        // $profile = new UserProfile();
        // $profile->setUser($user);

        // $entityManager->persist($profile);
        // $entityManager->flush();

        // Find user profile by user ID
        // $userProfile = $profiles->findOneBy(['user' => 8]); // possible also to use just find() method - it will find by foreign key and not by ID

        // if ($userProfile) {
        //     $entityManager -> remove($userProfile);
        //     $entityManager -> flush();
        // }


        // One To Many
        // Owning side in the relationship is the one that does not have the special field on it for the relation to exist - if the field specifying the post ID is the comment that means that microPost is the owning side - so microPost can exist without comments, it can optionally have some comments associated. But in order for comment to exist, it is mandatory to be associated with some post.

        // $post = new MicroPost();
        // $post -> setTitle('My first post');
        // $post -> setText('Hello brothers');
        // $post -> setCreatedAt(new DateTime());

        /** @var MicroPost $post */
        //$post = $posts->find(19);
        //dd($post); // comments not fetched - lazy loading. Doctrine ORM loads data which we asked for.

        //$comment = $post -> getComments()[0];

        //$post -> removeComment($comment); // only way to delete comment from post
        
        // $comment = new Comment();
        // $comment -> setText('Second comment woot woot!');
        // $comment -> setMicroPost($post);
        
        // // $post -> addComment($comment);

        //$entityManager -> persist($post);
        // $entityManager -> persist($comment);
        //$entityManager -> flush();


        

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
