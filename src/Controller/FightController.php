<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\BossRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FightController extends AbstractController
{
    #[Route('/fight', name: 'app_fight')]
    public function fightRing(BossRepository $bossRepository): Response
    {
        $user = $this->getUser();
        $player = $user->getCharacter();
        $allBosses = $bossRepository->findAll();
        $bossBeaten = $user->getBossBeaten();
        $bossArray = [];
        $topId = -1;
        $id = -2;
        $newBoss = null;
        foreach ($bossBeaten as $boss) {
            $bossArray[] = $boss;
        }
        foreach ($allBosses as $boss) {

            if (in_array($boss, $bossArray)) {
                $id = $boss->getId();
                //getId of the boss
                //store the value
            }
            if ($id > $topId) {
                $topId = $id;
            }
            //Store the highest value of id
        }
        while ($newBoss == null) {
            $newBossId = $topId + 1;
            $newBoss = $bossRepository->findById($newBossId);
            $topId = $topId + 1;
        }
        //if newBoss is null, have to find the lowest Boss id

    }
}
