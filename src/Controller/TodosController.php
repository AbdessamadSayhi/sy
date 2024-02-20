<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TodosController extends AbstractController
{
    #[Route('todo', name: 'list_todo')]
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
            $this->addFlash('success', "La liste des Todos a été initialisée avec succès");
        }
        return $this->render('todos/index.html.twig', [
            'controller_name' => 'TodosController',
        ]);
    }

    #[Route('todo/add/{category}/{task}', name: 'add_todo')]
    public function addTodo(string $category, string $task, Request $request): RedirectResponse
    {
        $session = $request->getSession();
        $todos = $session->get('todos', []);
        if (isset($todos[$category])) {
            $this->addFlash("error", "Le Todo existe déjà !");
        } else {
            $todos[$category] = $task;
            $session->set('todos', $todos);
            $this->addFlash('success', "Le Todo a été ajouté avec succès");
        }
        return $this->redirectToRoute('list_todo');
    }

    #[Route('todo/delete/{category}', name: 'delete_todo')]
    public function deleteTodo(string $category, Request $request): RedirectResponse
    {
        $session = $request->getSession();
        $todos = $session->get('todos', []);
        if (isset($todos[$category])) {
            unset($todos[$category]);
            $session->set('todos', $todos);
            $this->addFlash("success", "Le Todo a été supprimé avec succès");
        } else {
            $this->addFlash('error', "Le Todo n'existe pas");
        }
        return $this->redirectToRoute('list_todo');
    }

    #[Route('todo/edit/{category}/{newCategory}', name: 'edit_todo')]
    public function editTodo(string $category, string $newCategory, Request $request): RedirectResponse
    {
        $session = $request->getSession();
        $todos = $session->get('todos', []);

        if (isset($todos[$category])) {
            $todos[$newCategory] = $todos[$category];
            unset($todos[$category]);
            $session->set('todos', $todos);
            $this->addFlash("success", "Le Todo a été modifié avec succès");
        } else {
            $this->addFlash('error', "Le Todo n'existe pas");
        }
        return $this->redirectToRoute('list_todo');
    }

    #[Route('todo/reset', name: 'todo_reset')]
    public function resetTodo(Request $request): Response
    {
        $session = $request->getSession('todos');
        $session->remove('todos');
        $this->addFlash('success', "Le to-do a été réinitialiser");
        return $this->redirectToRoute('list_todo');
    }
}
