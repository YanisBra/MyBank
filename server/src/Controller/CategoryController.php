<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category')]
final class CategoryController extends AbstractController
{
    #[Route(name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        // return $this->render('category/index.html.twig', [
        //     'categories' => $categoryRepository->findAll(),
        // ]);

         $categories = $categoryRepository->findAll();

    return $this->json($categories, 200, [], ['groups' => 'category:read']);
    }

    // #[Route('/new', name: 'app_category_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $category = new Category();
    //     $form = $this->createForm(CategoryType::class, $category);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($category);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('category/new.html.twig', [
    //         'category' => $category,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/new', name: 'app_category_new', methods: ['POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $data = json_decode($request->getContent(), true);

    $category = new Category();
    $category->setTitle($data['title']); 

    $entityManager->persist($category);
    $entityManager->flush();

    return $this->json($category, 201, [], ['groups' => 'category:read']);
}

    #[Route('/{id}', name: 'app_category_show', methods: ['GET'])]
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    // #[Route('/{id}/edit', name: 'app_category_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(CategoryType::class, $category);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('category/edit.html.twig', [
    //         'category' => $category,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}/edit', name: 'app_category_edit', methods: ['PUT', 'PATCH'])]
public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
{
    // Décoder les données JSON de la requête
    $data = json_decode($request->getContent(), true);

    // Mettre à jour les propriétés de l'entité Category avec les nouvelles valeurs
    if (isset($data['title'])) {
        $category->setTitle($data['title']);
    }

    // Enregistrer les modifications dans la base de données
    $entityManager->flush();

    // Retourner la catégorie modifiée au format JSON
    return $this->json($category, 200, [], ['groups' => 'category:read']);
}

    // #[Route('/{id}', name: 'app_category_delete', methods: ['POST'])]
    #[Route('/{id}', name: 'app_category_delete', methods: ['DELETE'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->getPayload()->getString('_token'))) {
        //     $entityManager->remove($category);
        //     $entityManager->flush();
        // }

        // return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    $entityManager->remove($category);
    $entityManager->flush();

    // Retourner une réponse JSON
    return $this->json(['message' => 'Category deleted successfully'], 200);
    }
}
