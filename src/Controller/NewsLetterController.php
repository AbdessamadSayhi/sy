<?php

namespace App\Controller;

use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsLetterController extends AbstractController
{
    #[Route('subscribe', name: 'newsletter_subscribe')]
    public function index(): Response
    {
        return $this->render('news_letter/index.html.twig', [
            'controller_name' => 'NewsLetterController',
        ]);
    }
}
