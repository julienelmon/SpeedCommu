<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Login;
use App\Form\PostType;

use App\Repository\FollowRepository;
use App\Repository\LoginRepository;
use App\Repository\PostRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PostController extends AbstractController
{
    /**
     * @var ObjectManager
     */

    private $em;

    public function __construct(EntityManagerInterface $em, FollowRepository $repositoryFollow, LoginRepository $respositoryLogin, PostRepository $repositoryPost)
    {
        $this->em = $em;
        $this->repositoryFollow = $repositoryFollow;
        $this->repositoryLogin = $respositoryLogin;
        $this->repositoryPost = $repositoryPost;
    }

    /**
     * @Route("/post/{id}", name="post")
     * @param Login $login
     * @return Response  
     */
    public function index(Request $request, Login $login)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $post->setAuthor($login->getFirstname());
            $post->setUser($login);
            $this->em->persist($post);
            $this->em->flush();
            $this->addFlash('success', 'Post envoyer avec succées');
            return $this->redirectToRoute('home');
        }

        $followsUser = $this->repositoryFollow->findByUserId($this->getUser());
        
        $posts = [];
        foreach($followsUser as $key => $followUser){
            $posts[$key] = $this->repositoryPost->findOneBy(['user' => $followUser]);
        }

        dump($posts);
        
        return $this->render('post/index.html.twig', [
            'form' => $form->createView(),
            'posts' => $posts
        ]);
    }
}

?>