<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LuckyController extends AbstractController
{

    #[Route('/luckynum/{min<\d+>}/{max<\d+>}', name: 'luckynum')]
    public function number($min, $max): Response
    {
        if ($min < $max) {
            $number = random_int($min, $max);
        } else {
            $number = 0;
        }
        return $this->render('lucky/index.html.twig', [
            'luckyNumber' => $number,
        ]);
    }

    #[Route('/luckynum', name: 'luckynum')]
    public function randNumber(): Response
    {
        $number = random_int(0, 20);
        return $this->render('lucky/index.html.twig', [
            'luckyNumber' => $number,
        ]);
    }


    #[Route('/oddnum', name: "oddnum")]
    public function oddNumber(): Response
    {
        $number = random_int(0, 20);
        if ($number % 2 == 0) {
            return $this->redirectToRoute('luckynum');
        } else {
            return $this->render('lucky/index.html.twig', [
                'luckyNumber' => $number,
            ]);
        }
    }
}
