<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Doctor;
use App\Entity\OpeningHour;
use App\Entity\SocialNetworks;
use App\Form\AppointmentFrontType;
use App\Repository\OpeningHourRepository;
use App\Repository\SocialNetworksRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET', 'POST'])]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        // Récupérer en base de données la liste des docteurs
        // SELECT * FROM doctor WHERE first_name = 'John' ORDER BY first_name ASC, last_name ASC
        // $doctors = $doctrine->getRepository(Doctor::class)->findByFirstName('Jack', ['firstName' => 'ASC', 'lastName' => 'ASC']);
        // SELECT * FROM doctor ORDER BY first_name ASC, last_name ASC
        // $doctors = $doctrine->getRepository(Doctor::class)->findBy([], ['firstName' => 'ASC', 'lastName' => 'ASC']);
        $doctors = $doctrine->getRepository(Doctor::class)->findAllWithJoins();
        $openingHours = $doctrine->getRepository(OpeningHour::class)->findBy([], ['weekNumber' => 'ASC']);
        $appointmentSaved = false;

        $appointment = new Appointment();
        $form = $this->createForm(AppointmentFrontType::class, $appointment);

        $form->handleRequest($request); // Récupérer les données de $_POST
        if ($form->isSubmitted() && $form->isValid()) {
            $appointment->setUser($this->getUser());
            $doctrine->getManager()->persist($appointment); // Ajoute le nouveau rdv dans Doctrine
            $doctrine->getManager()->flush(); // Enregistrer en base de données
            $appointmentSaved = true;
        }

        return $this->renderForm('default/index.html.twig', [
            'doctors' => $doctors, // Envoyer la liste des docteurs au template Twig
            'openingHours' => $openingHours, // Envoyer la liste des horaires d'ouverture au template Twig
            'today' => new \DateTime(),
            'form' => $form,
            'appointmentSaved' => $appointmentSaved,
            'appointment' => $appointment
        ]);
    }

    public function header(SocialNetworksRepository $socialNetworksRepository): Response
    {
        return $this->render('default/_header.html.twig', [
            'socialNetworks' => $socialNetworksRepository->findBy([], ['name' => 'ASC']),
            'today' => new \DateTime()
        ]);
    }


    public function footer(OpeningHourRepository $openingHourRepository): Response
    {
        return $this->render('default/_footer.html.twig', [
            'openingHours' => $openingHourRepository->findBy([], ['weekNumber' => 'ASC']),
            'today' => new \DateTime()
        ]);
    }
}
