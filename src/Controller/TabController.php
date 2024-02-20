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

    #[Route('/tab/users', name: 'users')]
    public function users(): Response
    {
        $users = [
            ['firstname' => 'Abdessamad', 'lastname' => 'Sayhi', 'age' => 25,],
            ['firstname' => 'User1', 'lastname' => 'User1', 'age' => 30,],
            ['firstname' => 'user2', 'lastname' => 'User2', 'age' => 20,],
        ];
        return $this->render('tab/users.html.twig', [
            'users' => $users,
        ]);
    }
}
