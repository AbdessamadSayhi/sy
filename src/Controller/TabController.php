<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TabController extends AbstractController
{
    #[Route('/tab/{num<\d+>?5}', name: 'app_tab')]
    public function index(int $num): Response
    {
        $notes = [];
        for ($i = 0; $i < $num; $i++) {
            $notes[] = rand(0, 20);
        }
        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }
}
