<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


#[Route('todo', name: 'default_todo')]
class TodosController extends AbstractController
{
    #[Route('/', name: 'list_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('todos')) {
            $todos = [
                'Work' => 'Clean Code & SOLID',
                'Family' => 'Call every 2nd day',
                'Health' => 'Exercise every 3 days',
            ];
            $session->set('todos', $todos);
        }

        return $this->render(
            'todos/index.html.twig',
            [
                'controller_name' => 'TodosController',
            ]
        );
    }

    #[Route('add/{category}/{task}', name: 'add_todo')]
    public function addTodo($category, $task, Request $request): RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has('todos')) {
            $todos = $session->get('todos');
            if (isset($todos[$category])) {
                $this->addFlash("error", "Le Todo exsist deja !");
            } else {
                $todos[$category] = $task;
                $session->set('todos', $todos);
                $this->addFlash('success', "Le TODO d'id $category a ete ajoute avec succes");
            }
        } else {
            $this->addFlash("error", "La list des Todos viens n'est pas encore initialisee");
        }
        return $this->redirectToRoute('todo');
    }

    #[Route('delete/{category}/{task}', name: 'delete_todo')]
    public function deleteTodo($category, Request $request): RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has('todos')) {
            $todos = $session->get('todos');
            if (isset($todos[$category])) {
                unset($todos[$category]);
                $session->set('todos', $todos);
                $this->addFlash("success", "Le Todo a ete supprimer!");
            } else {
                $this->addFlash('error', "Le TODO d'id $category n'exist pas");
            }
        } else {
            $this->addFlash("error", "La list des Todos viens n'est pas encore initialisee");
        }
        return $this->redirectToRoute('todo');
    }

    #[Route('edit/{category}/{ncategory}', name: 'edit_todo')]
    public function editTodo($category, $ncategory, Request $request): RedirectResponse
    {
        $session = $request->getSession('todos');
        if ($session->has('todos')) {
            $todos = $session->get('todos');
            if (isset($todos[$category])) {
                $ncategory = str_replace('%20', ' ', $ncategory);
                $todos[$category] = $ncategory;
            }
            $session->set('todos', $todos);
            $this->addFlash("success", "Le Todo a ete modifier");
        } else {
            $this->addFlash('error', "Le TODO d'id $category n'exist pas");
        }
        return $this->redirectToRoute('todo');
    }
}
