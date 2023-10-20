<?php

namespace App\Controller;

use App\Entity\Operateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OperateurController extends AbstractController
{
    #[Route('/operateur', name: 'operateur')]
    public function index(): Response
    {
        return $this->render('operateur/index.html.twig');
    }
}
