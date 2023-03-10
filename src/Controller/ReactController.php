<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\Versus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReactController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        $user = $this->getUser();
        if ($user) {
            if ($user->getCharacter()) {
                return $this->redirectToRoute('app_avatar');
            }
            return $this->render('react/home.html.twig', []);
        }
        return $this->redirectToRoute('app_login');
    }
    #[Route('/newheroe', name: 'app_new_heroe')]
    public function createYourHeroe(Request $request, EntityManagerInterface $em): Response
    {
        $data = json_decode($request->getContent(), true);
        $text = $data['text'];
        $player = new Character;
        $player->setArmor(0);
        $player->setCritChance(0.1);
        $player->setCritDamage(2);
        $player->setHp(100);
        $player->setName($text);
        $player->setPhysicalDamage(10);
        $player->setPlayer($this->getUser());
        $em->persist($player);
        $em->flush();

        return new JsonResponse(['status' => 'success']);
    }
    #[Route('/avatar', name: 'app_avatar')]
    public function avatar(): Response
    {

        return $this->render('react/avatar.html.twig', []);
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
