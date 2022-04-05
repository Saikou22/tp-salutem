<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\OpeningHour;
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
        // SELECT * FROM doctor WHERE first_name = 'John' ORDER BY first_name ASC, last_name ASC
        // $doctors = $doctrine->getRepository(Doctor::class)->findByFirstName('Jack', ['firstName' => 'ASC', 'lastName' => 'ASC']);
        // SELECT * FROM doctor ORDER BY first_name ASC, last_name ASC
        // $doctors = $doctrine->getRepository(Doctor::class)->findBy([], ['firstName' => 'ASC', 'lastName' => 'ASC']);
        $doctors = $doctrine->getRepository(Doctor::class)->findAllWithJoins();
        $openingHours = $doctrine->getRepository(OpeningHour::class)->findBy([], ['weekNumber' => 'ASC']);

        return $this->render('default/index.html.twig', [
            'doctors' => $doctors, // Envoyer la liste des docteurs au template Twig
            'openingHours' => $openingHours, // Envoyer la liste des horaires d'ouverture au template Twig
            'today' => new \DateTime()
        ]);
    }
}
