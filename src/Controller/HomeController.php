<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    //default value ?unknowen
    #[Route('/home/{name?unknown}', name: 'app_home')]
    public function index($name): Response
    {
        return $this->render('home/index.html.twig', [
            'name' => $name,
        ]);
    }
}
