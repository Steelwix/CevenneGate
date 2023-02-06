<?php

namespace App\Controller;

use App\Entity\Boss;
use App\Entity\Character;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BossController extends AbstractController
{
    #[Route('/boss', name: 'app_boss')]
    public function bossMaker(EntityManagerInterface $entityManager): Response
    {
        $allBosses = [];
        for ($i = 0; $i < 41; $i++) {
            $boss = new Boss;
            $monster = new Character;
            $monster->setArmor(0 + $i);
            $monster->setCritChance((mt_rand(0, 100) * $i) / 10000);
            $monster->setCritDamage(((mt_rand(0, 100) * $i)) / (mt_rand(2000, 8000)));
            $monster->setHp(100 + (mt_rand(0, 50) * $i));
            $monster->setPhysicalDamage(10 + (mt_rand(0, 10) * $i));
            $monster->setName(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 7));
            $monster->setBoss($boss);
            $boss->setName($monster->getName());
            $allBosses[] = $boss;
        }
        foreach ($allBosses as $bosses) {
            $entityManager->persist($bosses);
            $entityManager->flush($bosses);
        }
        return $this->redirectToRoute('app_home');
    }
}
