<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
