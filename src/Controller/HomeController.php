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
        // Retrieve or initiate the nbVisite value from the session:
        $nbVisite = $this->session->get('nbVisite', 1); // Default to 1 if not set

        // Increment the visit count:
        $nbVisite++;

        // Store the updated nbVisite in the session:
        $this->session->set('nbVisite', $nbVisite);

        // Render the template with the data:
        return $this->render('home/index.html.twig', [
            'name' => $name,
            'nbVisite' => $nbVisite,
        ]);
    }
}
