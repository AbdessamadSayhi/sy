<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FirstController extends AbstractController
{
    #[Route('/first/{$nb}', name: 'app_first')]
    public function index(int $nb): Response
    {
        $notes = [];
        for ($i = 0; $i < $nb; $i++) {
            $notes[] = rand(0, 20);
        }
        return $this->render('first/index.html.twig', [
            'notes' => $notes,
        ]);
    }

    #[Route('date', name: 'date')]
    public function thisDate(): Response
    {
        return $this->render('fragments/date.html.twig');
    }
}
