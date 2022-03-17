<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/categor", name="app_category_")
 */
class CategoryController extends AbstractController
{
    /**
     * Liste des catégories
     * 
     * @Route("ies", name="index", methods={"HEAD","GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }


    /**
     * Créer une catégorie
     * 
     * @Route("y", name="create", methods={"HEAD", "GET", "POST"})
     */
    public function create(ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator): Response
    {
        // Initialisation du l'entité
        $category = new Category;

        // Construction du formulaire
        $form = $this->createForm(CategoryType::class, $category);

        // Récupération de la requete HTTP
        $form->handleRequest($request);

        // Test la soumission du formulaire
        if ($form->isSubmitted())
        {
            // Récupération du CSRF Token
            $csrf_token = $request->request->get( $form->getName() )['_csrf_category_token'];

            // Vérifier l'intégrité du formulaire (CSRF Token)
            if ( ! $this->isCsrfTokenValid('_csrf_category_token_id', $csrf_token) )
            {
                throw new \Exception("Erreur de token");
            }
            
            // Validation du formulaire
            $validator->validate( $category );

            if ($form->isValid())
            {
                // Ajouter des valeurs par défaut

                // Enregistrement des données en BDD
                $em = $doctrine->getManager();
                $em->persist( $category );
                $em->flush();

                // Redirection de l'utilisateur vers la page du détail de la catégorie
                return $this->redirectToRoute('app_category_read', [
                    'id' => $category->getId()
                ]);
            }
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
     * @Route("y/{id}", name="read", methods={"HEAD", "GET"})
     */
    public function read(Category $category): Response
    {
        return $this->render('category/read.html.twig', [
            'category' => $category
        ]);
    }


    /**
     * Editer une catégorie
     * 
     * @Route("y/{id}/edit", name="update", methods={"HEAD", "GET", "POST"})
     */
    public function update(Category $category, ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator): Response
    {
        // Construction du formulaire
        $form = $this->createForm(CategoryType::class, $category);

        // Récupération de la requete HTTP
        $form->handleRequest($request);

        // Test la soumission du formulaire
        if ($form->isSubmitted())
        {
            // Récupération du CSRF Token
            $csrf_token = $request->request->get( $form->getName() )['_csrf_category_token'];

            // Vérifier l'intégrité du formulaire (CSRF Token)
            if ( ! $this->isCsrfTokenValid('_csrf_category_token_id', $csrf_token) )
            {
                throw new \Exception("Erreur de token");
            }
            
            // Validation du formulaire
            $validator->validate( $category );

            if ($form->isValid())
            {
                // Ajouter des valeurs par défaut

                // Enregistrement des données en BDD
                $em = $doctrine->getManager();
                $em->persist( $category );
                $em->flush();



                // Redirection de l'utilisateur vers la page du détail de la catégorie
                return $this->redirectToRoute('app_category_read', [
                    'id' => $category->getId()
                ]);
            }
        }

        // Préparation du formulaire pour la vue
        $form = $form->createView();

        // Transmission du formulaire à la vue
        return $this->render('category/update.html.twig', [
            'form' => $form
        ]);
    }


    /**
     * Supprimer une catégorie
     * 
     * /!\ dans le fichier config/packages/framework.yaml, modifier le parametre "http_method_override"
     * framework:
     *      http_method_override: true
     * 
     * @Route("y/{id}/delete", name="delete", methods={"HEAD", "GET", "DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, Category $category, Request $request): Response
    {
        // Condition
        if ($request->getMethod() == 'DELETE')
        {
            // Générer le message de confirmation d'execution de la suppression
            $message = "La categorie <strong>". $category->getName() ."</strong> à été supprimée";

            // Suppression de la BDD
            $em = $doctrine->getManager();
            $em->remove( $category );
            $em->flush();

            // Ajout du message dans la session
            $this->addFlash('success', $message);

            // Redirection de l'utilisateur
            return $this->redirectToRoute('app_category_index');
        }

        // Affichage d'un message de confirmation de suppression
        return $this->render('category/delete.html.twig', [
            'category' => $category
        ]);
    }

}
