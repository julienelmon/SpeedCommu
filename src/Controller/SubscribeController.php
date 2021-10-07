<?php

namespace App\Controller;

use App\Entity\Login;
use App\Form\SubscribeType;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use  Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SubscribeController extends AbstractController {

    /**
     * @var ObjectManager
     */
 
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/subscribe", name="subscribe.news")
     */

    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, FileUploader $file_uploader)
    {
        $newLogin = new Login();
        $form = $this->createForm(SubscribeType::class, $newLogin);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $file = $form['url_picture']->getData();
            
            if($file)
            {
                $file_name = $file_uploader->upload($file);
                if (null !== $file_name)
                {
                    $full_path = 'uploads/'.$file_name;
                    $newLogin->setUrlPicture($full_path);
                }
                
            }
            $newLogin->setPassword(
                $passwordEncoder->encodePassword(
                    $newLogin,
                    $form->get('plainPassword')->getData()
                )
            );
            
            $this->em->persist($newLogin);
            $this->em->flush();
            $this->addFlash('success', 'Compte crée avec succées');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('subscribe/new.html.twig', [
            'newLogin' => $newLogin,
            'form' => $form->createView() 
        ]);
    }
}

?>