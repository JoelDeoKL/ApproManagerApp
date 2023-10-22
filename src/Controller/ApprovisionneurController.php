<?php

namespace App\Controller;

use App\Entity\Declaration;
use App\Entity\ProcesVerbal;
use App\Form\PVType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApprovisionneurController extends AbstractController
{
    #[Route('/approvisionneur', name: 'app_approvisionneur')]
    public function index(): Response
    {
        return $this->render('approvisionneur/index.html.twig');
    }

    #[Route('/stocks', name: 'stocks')]
    public function stocks(EntityManagerInterface $entityManager): Response
    {
        $declarations = $entityManager->getRepository(Declaration::class)->findAll();

        return $this->render('approvisionneur/declarations.html.twig', ['declarations' => $declarations]);
    }

    #[Route('/editer_pv/{id?0}', name: 'editer_pv')]
    public function editer_pv(ProcesVerbal $proces_verbal = null, ManagerRegistry $doctrine, Request $request): Response
    {
        $new = false;
        if(!$proces_verbal){
            $new = true;
            $proces_verbal = new ProcesVerbal();
        }

        $form = $this->createForm(PVType::class, $proces_verbal);

        //dd($request->request);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager = $doctrine->getManager();
            $manager->persist($proces_verbal);

            $manager->flush();

            if($new){
                $message = "Le pv a été ajouter avec succès";
            }else{
                $message = "Le pv a été editer avec succès";
            }

            $this->addFlash("succes", $message);

            return $this->redirectToRoute("les_pv");
        }else{
            return $this->render('approvisionneur/add_pv.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    #[Route('/les_pv', name: 'les_pv')]
    public function les_pv(EntityManagerInterface $entityManager): Response
    {
        $pvs = $entityManager->getRepository(ProcesVerbal::class)->findAll();

        return $this->render('approvisionneur/pvs.html.twig', ['pvs' => $pvs]);
    }

}
