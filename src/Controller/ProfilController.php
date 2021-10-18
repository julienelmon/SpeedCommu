<?php

namespace App\Controller;

use App\Entity\Login;
use App\Entity\SocialNetwork;
use App\Form\SocialNetworkType;
use App\Form\SubscribeType;
use App\Repository\LoginRepository;
use App\Repository\SocialNetworkRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProfilController extends AbstractController
{
    /**
     * @var ObjectManager
     */

    private $em;

     public function __construct(EntityManagerInterface $em, LoginRepository $repositoryLogin, SocialNetworkRepository $repositorySocialNetwork)
     {
        $this->em = $em;
        $this->repositoryLogin = $repositoryLogin;
        $this->repositorySocialNetwork = $repositorySocialNetwork;
     }

     /**
      * @Route("/profile/{id}", name="profil")
      */

     public function index($id)
     {
        $verifyLink = $this->repositorySocialNetwork->findOneBySomeField($id);
        return $this->render('profil/index.html.twig', [
            'viewProfilLink' => $verifyLink,
        ]);
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

    /**
     * @Route("/profile/addlink/{id}", name="prodil.addlink")
     * @param Login $login
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function addProfile(Login $login, Request $request)
    {
        $socialNetwork = new SocialNetwork();
        $form = $this->createForm(SocialNetworkType::class, $socialNetwork);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $socialNetwork->setLogin($login);
            $this->em->persist($socialNetwork);
            $this->em->flush();
            $this->addFlash('success', 'Lien ajouté avec succès');
            return $this->redirectToRoute('home');
        }
        
        return $this->render('profil/addlink.html.twig', [
            'form' => $form->createView()
        ]);
        
    }

    /**
     * @Route("/profile/viewuser/{id}", name="profil.view")
     * @param Login $id
     */

    public function profilView($id)
    {
        $viewProfil = $this->repositoryLogin->find($id);
        $viewProfilLink = $this->repositorySocialNetwork->findOneBySomeField($id);

        return $this->render('profil/profilview.html.twig', [
            'viewProfil' => $viewProfil,
            'viewProfilLink' => $viewProfilLink
        ]);
    }
    
    /**
     * @Route("/profile/editlink/{id}", name="profil.link.modif")
     * @param Login $id
     * @param SocialNetwork $socialNetwork
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function editLink(SocialNetwork $socialNetwork, Request $request)
    {
        $form = $this->createForm(SocialNetworkType::class, $socialNetwork);
        $form->handleRequest($request);
        dump('test');

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Lien mis à jour avec succès');
            return $this->redirectToRoute('home');
        }

        return $this->render('profil/editlink.html.twig', [
            'socialNetwork' => $socialNetwork, 
            'form' => $form->createView()
        ]);
    }
}

?>