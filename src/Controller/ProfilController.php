<?php

namespace App\Controller;

use App\Entity\Login;
use App\Form\SubscribeType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilController extends AbstractController
{
    /**
     * @var ObjectManager
     */

    private $em;

     public function __construct(EntityManagerInterface $em)
     {
        $this->em = $em;
     }

     /**
      * @Route("/profile", name="profil")
      */

     public function index()
     {
         return $this->render('profil/index.html.twig');
     }

    /**
     * @Route("/profile/edit/{id}", name="profil.edit.add")
     * @param Login $login
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

     public function editProfil(Login $login, UserPasswordEncoderInterface $passwordEncoder, Request $request, FileUploader $file_uploader)
     {
        $form = $this->createForm(SubscribeType::class, $login);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $file = $form['url_picture']->getData();

            if($file)
            {
                $oldPicture = $login->getUrlPicture();
                $file_name = $file_uploader->upload($file);

                if (null !== $file_name)
                {
                    $full_path = 'uploads/'.$file_name;
                    $login->setUrlPicture($full_path);
                }
            }
            $login->setPassword(
                $passwordEncoder->encodePassword(
                    $login,
                    $form->get('plainPassword')->getData()
                )
            );
            $this->em->flush();
            $this->addFlash('success', 'Information modifié avec succès');
            return $this->redirectToRoute('home');
        }
        return $this->render('profil/edit.html.twig', [
            'login' => $login,
            'form' => $form->createView()
        ]);
     }
}

?>