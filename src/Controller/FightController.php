<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FightController extends AbstractController
{
    #[Route('/fight', name: 'app_fight')]
    public function index(): Response
    {
        return $this->render('fight/index.html.twig', [
            'controller_name' => 'FightController',
        ]);
    }
}
