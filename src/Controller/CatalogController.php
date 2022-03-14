<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    /** 
     * Affiche la liste des produits
     * 
     * @Route("", name="")
     */
    public function index(): Response
    {
        return $this->render('catalog/index.html.twig', [
        ]);
    }


    /**
     * Ajoute un produit dans la BDD
     * 
     * @Route("", name="")
     */
    public function create()
    {
    }


    /**
     * Affiche le détail d'un produit
     * 
     * @Route("", name="")
     */
    public function read()
    {
    }


    /**
     * Modifier la fiche d'un produit
     * 
     * @Route("", name="")
     */
    public function update()
    {
    }


    /**
     * Supprimer la fiche d'un produit
     * 
     * @Route("", name="")
     */
    public function delete()
    {
    }
}
