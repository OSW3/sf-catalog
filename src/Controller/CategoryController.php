<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categor", name="app_category_")
 */
class CategoryController extends AbstractController
{
    /**
     * Liste des catégories
     * 
     * @Route("ies", name="index")
     */
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
        ]);
    }


    /**
     * Créer une catégorie
     * 
     * @Route("y", name="create")
     */
    public function create(Request $request): Response
    {
        // Initialisation du l'entité
        $category = new Category;

        // Construction du formulaire
        $form = $this->createForm(CategoryType::class);

        // Récupération de la requete HTTP
        $form->handleRequest($request);

        // Test la soumission du formulaire
        if ($form->isSubmitted())
        {

            // Debug du formulaire

            // Vérifier l'intégrité du formulaire (CSRF Token)
                // Message d'erreur de token
            
            // Validation du formulaire

                // Ajouter des valeurs par défaut

                // Enregistrement des données en BDD

                // Redirection de l'utilisateur vers la page du détail de la catégorie

        }

        // Préparation du formulaire pour la vue
        $form = $form->createView();

        // Transmission du formulaire à la vue
        return $this->render('category/create.html.twig', [
            'form' => $form
        ]);
    }


    /**
     * Lire le détail d'une catégorie
     * 
     * @Route("y/{id}", name="read")
     */
    public function read(): Response
    {
    }


    /**
     * Editer une catégorie
     * 
     * @Route("y/{id}/edit", name="update")
     */
    public function update(): Response
    {
    }


    /**
     * Supprimer une catégorie
     * 
     * @Route("y/{id}/delete", name="delete")
     */
    public function delete(): Response
    {
    }

}
