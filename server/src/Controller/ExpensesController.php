<?php

namespace App\Controller;

use App\Entity\Expenses;
use App\Entity\Category;
use App\Form\ExpensesType;
use App\Repository\ExpensesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/expenses')]
final class ExpensesController extends AbstractController
{
    #[Route(name: 'app_expenses_index', methods: ['GET'])]
    public function index(ExpensesRepository $expensesRepository): Response
    {
        // return $this->render('expenses/index.html.twig', [
        //     'expenses' => $expensesRepository->findAll(),
        // ]);
            $expenses = $expensesRepository->findAll();

    return $this->json($expenses, 200, [], ['groups' => 'expense:read']);
      
        
    }

    // #[Route('/new', name: 'app_expenses_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $expense = new Expenses();
    //     $form = $this->createForm(ExpensesType::class, $expense);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($expense);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_expenses_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('expenses/new.html.twig', [
    //         'expense' => $expense,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/new', name: 'app_expenses_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $expense = new Expenses();
        $expense->setAmount($data['amount']);
        $expense->setDateExpense(new \DateTimeImmutable($data['date_expense']));
        $expense->setDescription($data['description']);
        $category = $entityManager->getRepository(Category::class)->find($data['category_id']);
        $expense->setCategory($category);

        $entityManager->persist($expense);
        $entityManager->flush();

        return $this->json($expense, 201, [], ['groups' => 'expense:read']);
    }

    #[Route('/{id}', name: 'app_expenses_show', methods: ['GET'])]
    public function show(Expenses $expense): Response
    {
        return $this->render('expenses/show.html.twig', [
            'expense' => $expense,
        ]);
    }

    // #[Route('/{id}/edit', name: 'app_expenses_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Expenses $expense, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(ExpensesType::class, $expense);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_expenses_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('expenses/edit.html.twig', [
    //         'expense' => $expense,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}/edit', name: 'app_expenses_edit', methods: ['PUT', 'PATCH'])]
public function edit(Request $request, Expenses $expense, EntityManagerInterface $entityManager): Response
{
    // Décoder les données JSON de la requête
    $data = json_decode($request->getContent(), true);

    // Mettre à jour les propriétés de l'entité avec les nouvelles valeurs
    if (isset($data['amount'])) {
        $expense->setAmount($data['amount']);
    }
    if (isset($data['date_expense'])) {
        $expense->setDateExpense(new \DateTimeImmutable($data['date_expense']));
    }
    if (isset($data['description'])) {
        $expense->setDescription($data['description']);
    }
    if (isset($data['category_id'])) {
        $category = $entityManager->getRepository(Category::class)->find($data['category_id']);
        $expense->setCategory($category);
    }

    // Enregistrer les modifications dans la base de données
    $entityManager->flush();

    // Retourner la dépense modifiée au format JSON
    return $this->json($expense, 200, [], ['groups' => 'expense:read']);
}

    // #[Route('/{id}', name: 'app_expenses_delete', methods: ['POST'])]
    #[Route('/{id}', name: 'app_expenses_delete', methods: ['DELETE'])]
    public function delete(Request $request, Expenses $expense, EntityManagerInterface $entityManager): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$expense->getId(), $request->getPayload()->getString('_token'))) {
        //     $entityManager->remove($expense);
        //     $entityManager->flush();
        // }

        // return $this->redirectToRoute('app_expenses_index', [], Response::HTTP_SEE_OTHER);

         // Supprimer l'entité Expenses
    $entityManager->remove($expense);
    $entityManager->flush();

    // Retourner une réponse JSON
    return $this->json(['message' => 'Expense deleted successfully'], 200);
    }
}
