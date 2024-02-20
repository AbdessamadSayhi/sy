<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class HomeController extends AbstractController
{
    private SessionInterface $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getCurrentRequest()->getSession();
    }

    #[Route('/home/{name?default("unknown")}', name: 'home')]
    public function index($name): Response
    {
        $nbVisite = $this->session->get('nbVisite', 1);
        $nbVisite++;

        $this->session->set('nbVisite', $nbVisite);

        return $this->render('home/index.html.twig', [
            'name' => $name,
            'nbVisite' => $nbVisite,
            'path' => '',
        ]);
    }
}
