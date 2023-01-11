<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReactController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {

        return $this->render('react/home.html.twig', []);
    }
    #[Route('/react', name: 'app_react')]
    public function index(): Response
    {
        $favoriteFruit = "Citron";
        return $this->render('react/index.html.twig', [
            'controller_name' => 'ReactController', 'favoriteFruit' => $favoriteFruit
        ]);
    }
}
