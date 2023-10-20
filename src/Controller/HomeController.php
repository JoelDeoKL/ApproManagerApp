<?php

namespace App\Controller;

use App\Entity\Operateur;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
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
}
