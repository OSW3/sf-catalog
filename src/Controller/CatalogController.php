<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/product", name="app_catalog_")
 * 
 * site.com/products                Affiche la liste des produits
 * site.com/product                 Créer un produit
 * site.com/product/{id}            Affiche le détail d'un produit
 * site.com/product/{id}/edit       Modifier un produit
 * site.com/product/{id}/delete     Supprime un produit
 */
class CatalogController extends AbstractController
{
    /** 
     * Affiche la liste des produits
     * 
     * url ex: /products
     * name: app_catalog_index
     * 
     * @Route("s", name="index")
     */
    public function index(): Response
    {
        return $this->render('catalog/index.html.twig', [
        ]);
    }


    /**
     * Ajoute un produit dans la BDD
     * 
     * url ex: /product
     * name: app_catalog_create
     * 
     * @Route("", name="create")
     */
    public function create(ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator): Response
    {
        $errors = [];

        // Create Form
        // --

        // Initalisation du Produit
        $product = new Product;

        // Construction du formulaire
        $form = $this->createForm(ProductType::class, $product);

        // Handle the Request
        $form->handleRequest($request);

        // Catch form submission
        if ( $form->isSubmitted() )
        {
            // Check the form integrity (CSRF Token)
            $submittedToken = $request->request->get('product')['_csrf_product_token'];
            if (!$this->isCsrfTokenValid('_csrf_product_token_id', $submittedToken))
            {
                dd("Erreur de token");
            }

            // Handle form errors
            $errors = $validator->validate( $product );

            // If the form is valid
            if ( $form->isValid() )
            {
                
                // Enregistrement en BDD
                // $em = $this->getDoctrine()->getManager();
                $em = $doctrine->getManager();
                $em->persist( $product );
                $em->flush();

                // Rerdirection de l'utilisateur
                return $this->redirectToRoute('app_catalog_index');
            }
        }

        // Préparation du formulaire pour la vue
        $form = $form->createView();


        // Response HTTP
        // --

        return $this->render('catalog/create.html.twig', [
            'form' => $form
        ]);
    }


    /**
     * Affiche le détail d'un produit
     * 
     * url ex: /product/42
     * name: app_catalog_read
     * 
     * @Route("/{id}", name="read")
     */
    public function read(int $id): Response
    {
    }


    /**
     * Modifier la fiche d'un produit
     * 
     * url ex: /product
     * name: app_catalog_update
     * 
     * @Route("/{id}/edit", name="update")
     */
    public function update(int $id): Response
    {
    }


    /**
     * Supprimer la fiche d'un produit
     * 
     * url ex: /product
     * name: app_catalog_delete
     * 
     * @Route("/{id}/delete", name="delete")
     */
    public function delete(int $id): Response
    {
    }
}
