<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/product", name="app_product_")
 * 
 * site.com/products                Affiche la liste des produits
 * site.com/product                 Créer un produit
 * site.com/product/{id}            Affiche le détail d'un produit
 * site.com/product/{id}/edit       Modifier un produit
 * site.com/product/{id}/delete     Supprime un produit
 */
class ProductController extends AbstractController
{
    /** 
     * Affiche la liste des produits
     * 
     * @Route("s", name="index", methods={"HEAD","GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }


    /**
     * Ajoute un produit dans la BDD
     * 
     * url ex: /product
     * name: app_product_create
     * 
     * @Route("", name="create", methods={"HEAD","GET","POST"})
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
                return $this->redirectToRoute('app_product_index');
            }
        }

        // Préparation du formulaire pour la vue
        $form = $form->createView();


        // Response HTTP
        // --

        return $this->render('product/create.html.twig', [
            'form' => $form
        ]);
    }


    /**
     * Affiche le détail d'un produit
     * 
     * @Route("/{id}", name="read", methods={"HEAD","GET"})
     */
    public function read(Product $product): Response
    {
        return $this->render('product/read.html.twig', [
            'product' => $product,
        ]);
    }


    /**
     * Modifier la fiche d'un produit
     * 
     * url ex: /product
     * name: app_product_update
     * 
     * @Route("/{id}/edit", name="update", methods={"HEAD","GET","POST"})
     */
    public function update(Product $product, ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator): Response
    {
        $errors = [];

        // Create Form
        // --

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
                return $this->redirectToRoute('app_product_read', [
                    'id' => $product->getId()
                ]);
            }
        }

        // Préparation du formulaire pour la vue
        $form = $form->createView();


        // Response HTTP
        // --

        return $this->render('product/update.html.twig', [
            'form' => $form,
            'product' => $product,
        ]);
    }


    /**
     * Supprimer la fiche d'un produit
     * 
     * url ex: /product
     * name: app_product_delete
     * 
     * @Route("/{id}/delete", name="delete", methods={"HEAD","GET","DELETE"})
     */
    public function delete(Product $product, ManagerRegistry $doctrine, Request $request): Response
    {
        if ($request->getMethod() == 'DELETE')
        {
            $message = "Le produit <strong>". $product->getTitle() ."</strong> à été supprimé.";

            // Suppression de la BDD
            $em = $doctrine->getManager();
            $em->remove( $product );
            $em->flush();

            $this->addFlash('success', $message);

            return $this->redirectToRoute('app_product_index');
        }


        return $this->render('product/delete.html.twig', [
            'product' => $product
        ]);
    }
}
