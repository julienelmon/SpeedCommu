<?php

namespace App\Controller;

use App\Entity\PeopleSearch;
use App\Form\PeopleSearchType;
use App\Repository\LoginRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {



    public function __construct(LoginRepository $repository)
    {
        $this->repository = $repository;
    }

        /**
     * @Route("/", name="home")
     * @return Response  
    */

    public function index(LoginRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {
        $category = new PeopleSearch();
        $form = $this->createForm(PeopleSearchType::class, $category);
        $form->handleRequest($request);
        $peopleslastsub = $repository->findLatest();
        $peoples = $this->repository->findBySearch($category);
        $peoples = $paginator->paginate(
            $peoples,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('pages/home.html.twig', [
            'peopleslastsubs' => $peopleslastsub,
            'peoples' => $peoples,
            'form' => $form->createView()
        ]);
    }
}

?>