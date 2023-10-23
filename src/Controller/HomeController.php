<?php

namespace App\Controller;

use App\Entity\Declaration;
use App\Entity\Operateur;
use App\Entity\ProcesVerbal;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/redirection', name: 'redirection')]
    public function redirection(EntityManagerInterface $entityManager, Request $request): Response
    {
        $session = $request->getSession();

        $user = $entityManager->getRepository(User::class)->findBy(["email" => $session->all()["_security.last_username"]]);

        if ($user[0]->getRole() == "Operateur"){
            return $this->redirectToRoute("operateur");
        }elseif ($user[0]->getRole() == "Inspecteur DGDA"){
            return $this->redirectToRoute("dgda");
        }elseif ($user[0]->getRole() == "Inspecteur Division"){
            return $this->redirectToRoute("division");
        }elseif ($user[0]->getRole() == "Approvisionneur"){
            return $this->redirectToRoute("app_approvisionneur");
        }else{
            return $this->redirectToRoute("home");
        }
    }

    #[Route('/les_operateurs', name: 'les_operateurs')]
    public function les_operateurs(EntityManagerInterface $entityManager): Response
    {
        $operateurs = $entityManager->getRepository(User::class)->findBy(['role' => 'Opérateur']);

        return $this->render('home/operateurs.html.twig', ['operateurs' => $operateurs]);
    }

    #[Route('/les_inspecteurs', name: 'les_inspecteurs')]
    public function les_inspecteurs(EntityManagerInterface $entityManager): Response
    {
        $dgda = $entityManager->getRepository(User::class)->findBy(['role' => 'Inspecteur DGDA']);
        $division = $entityManager->getRepository(User::class)->findBy(['role' => 'Inspecteur Division']);

        $inspecteurs = array_merge($dgda, $division);

        return $this->render('home/inspecteurs.html.twig', ['inspecteurs' => $inspecteurs]);
    }

    #[Route('/approv', name: 'approv')]
    public function approv(EntityManagerInterface $entityManager): Response
    {
        $approvisionneurs = $entityManager->getRepository(User::class)->findBy(['role' => 'Approvisionneur']);

        return $this->render('home/approv.html.twig', ['approvisionneurs' => $approvisionneurs]);
    }

    #[Route('/stocks_provincial', name: 'stocks_provincial')]
    public function stocks_provincial(EntityManagerInterface $entityManager): Response
    {
        $declarations = $entityManager->getRepository(Declaration::class)->findAll();

        return $this->render('home/stocks.html.twig', ['declarations' => $declarations]);
    }
}
