<?php

namespace App\Controller;

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

    #[Route('/declaration', name: 'declaration')]
    public function declaration(): Response
    {
        return $this->render('home/declare.html.twig');
    }

    #[Route('/proces_verbal', name: 'proces_verbal')]
    public function proces_verbal(): Response
    {
        return $this->render('home/proces_verbal.html.twig');
    }

    #[Route('/rapport', name: 'rapport')]
    public function rapport(): Response
    {
        return $this->render('home/rapport.html.twig');
    }
}
