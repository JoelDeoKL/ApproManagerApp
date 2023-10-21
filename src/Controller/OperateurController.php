<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\User;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OperateurController extends AbstractController
{
    #[Route('/operateur', name: 'operateur')]
    public function operateur(EntityManagerInterface $entityManager): Response
    {
        $operateurs = $entityManager->getRepository(Produit::class)->findAll();

        return $this->render('operateur/index.html.twig', ['operateurs' => $operateurs]);
    }

    #[Route('/produits', name: 'produits')]
    public function produits(EntityManagerInterface $entityManager): Response
    {
        $produits= $entityManager->getRepository(Produit::class)->findAll();

        return $this->render('operateur/produits.html.twig', ['produits' => $produits]);
    }

    #[Route('/editer_produit/{id?0}', name: 'editer_produit')]
    public function editer_produit(Produit $produit = null, ManagerRegistry $doctrine, Request $request): Response
    {
        $new = false;
        if(!$produit){
            $new = true;
            $produit = new Produit();
        }

        $form = $this->createForm(ProduitType::class, $produit);

        //dd($request->request);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager = $doctrine->getManager();
            $manager->persist($produit);

            $manager->flush();

            if($new){
                $message = "Le produit a été ajouter avec succès";
            }else{
                $message = "Le produit a été editer avec succès";
            }

            $this->addFlash("succes", $message);

            return $this->redirectToRoute("produits");
        }else{
            return $this->render('operateur/add_produit.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

}
