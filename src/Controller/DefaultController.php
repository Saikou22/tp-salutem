<?php

namespace App\Controller;

use App\Entity\Doctor;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // Récupérer en base de données la liste des docteurs
        $doctors = $doctrine->getRepository(Doctor::class)->findAll();

        return $this->render('default/index.html.twig', [
            'doctors' => $doctors, // Envoyer la liste des docteurs au template Twig
        ]);
    }
}
