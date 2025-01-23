<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/categories')]
final class CategoriesController extends AbstractController
{
    #[Route(name: 'app_categories_index', methods: ['GET'])]
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        // return $this->render('categories/index.html.twig', [
        //     'categories' => $categoriesRepository->findAll(),
        // ]);

         $categories = $categoriesRepository->findAll();

    return $this->json($categories, 200, [], ['groups' => 'categories:read']);
    }

    // #[Route('/new', name: 'app_categories_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $categories = new Categories();
    //     $form = $this->createForm(CategoriesType::class, $categories);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($categories);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('categories/new.html.twig', [
    //         'categories' => $categories,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/new', name: 'app_categories_new', methods: ['POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $data = json_decode($request->getContent(), true);

    $categories = new Categories();
    $categories->setTitle($data['title']); 

    $entityManager->persist($categories);
    $entityManager->flush();

    return $this->json($categories, 201, [], ['groups' => 'categories:read']);
}

    #[Route('/{id}', name: 'app_categories_show', methods: ['GET'])]
    public function show(Categories $categories): Response
    {
        return $this->render('categories/show.html.twig', [
            'categories' => $categories,
        ]);
    }

    // #[Route('/{id}/edit', name: 'app_categories_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Categories $categories, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(CategoriesType::class, $categories);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('categories/edit.html.twig', [
    //         'categories' => $categories,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}/edit', name: 'app_categories_edit', methods: ['PUT', 'PATCH'])]
public function edit(Request $request, Categories $categories, EntityManagerInterface $entityManager): Response
{
    // Décoder les données JSON de la requête
    $data = json_decode($request->getContent(), true);

    // Mettre à jour les propriétés de l'entité Categories avec les nouvelles valeurs
    if (isset($data['title'])) {
        $categories->setTitle($data['title']);
    }

    // Enregistrer les modifications dans la base de données
    $entityManager->flush();

    // Retourner la catégorie modifiée au format JSON
    return $this->json($categories, 200, [], ['groups' => 'categories:read']);
}

    // #[Route('/{id}', name: 'app_categories_delete', methods: ['POST'])]
    #[Route('/{id}', name: 'app_categories_delete', methods: ['DELETE'])]
    public function delete(Request $request, Categories $categories, EntityManagerInterface $entityManager): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$categories->getId(), $request->getPayload()->getString('_token'))) {
        //     $entityManager->remove($categories);
        //     $entityManager->flush();
        // }

        // return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
    $entityManager->remove($categories);
    $entityManager->flush();

    // Retourner une réponse JSON
    return $this->json(['message' => 'Categories deleted successfully'], 200);
    }
}
