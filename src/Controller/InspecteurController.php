<?php

namespace App\Controller;

use App\Entity\Rapport;
use App\Entity\User;
use App\Form\RapportType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InspecteurController extends AbstractController
{
    #[Route('/inspecteur', name: 'app_inspecteur')]
    public function index(): Response
    {
        return $this->render('inspecteur/index.html.twig');
    }

    #[Route('/approvisionneur', name: 'approvisionneur')]
    public function approvisionneur(): Response
    {
        return $this->render('approvisionneur/index.html.twig');
    }

    #[Route('/operateurs', name: 'operateurs')]
    public function operateurs(EntityManagerInterface $entityManager): Response
    {
        $operateurs = $entityManager->getRepository(User::class)->findBy(['role' => 'Opérateur']);

        return $this->render('inspecteur/operateurs.html.twig', ['operateurs' => $operateurs]);
    }

    #[Route('/editer_rapport/{id?0}', name: 'editer_rapport')]
    public function editer_rapport(Rapport $rapport = null, ManagerRegistry $doctrine, Request $request): Response
    {
        $new = false;
        if(!$rapport){
            $new = true;
            $rapport = new Rapport();
        }

        $form = $this->createForm(RapportType::class, $rapport);

        //dd($request->request);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager = $doctrine->getManager();
            $manager->persist($rapport);

            $manager->flush();

            if($new){
                $message = "Le rapport a été ajouter avec succès";
            }else{
                $message = "Le rapport a été editer avec succès";
            }

            $this->addFlash("succes", $message);

            return $this->redirectToRoute("rapports");
        }else{
            return $this->render('inspecteur/add_rapport.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    #[Route('/rapports', name: 'rapports')]
    public function rapports(EntityManagerInterface $entityManager): Response
    {
        $rapports = $entityManager->getRepository(Rapport::class)->findAll();

        return $this->render('inspecteur/rapports.html.twig', ['rapports' => $rapports]);
    }

}
