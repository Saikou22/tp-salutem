<?php

namespace App\Controller;

use App\Entity\MedicalArea;
use App\Repository\MedicalAreaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedicalAreaController extends AbstractController
{
    #[Route('/etablissements', name: 'app_medical_area', methods: ['GET'])]
    public function index(MedicalAreaRepository $medicalAreaRepository): Response
    {
        return $this->render('medical_area/index.html.twig', [
            'medicalAreas' => $medicalAreaRepository->findAll(),
        ]);
    }

    #[Route('/etablissement/{id}', name: 'app_medical_area_show', methods: ['GET'])]
    public function show(MedicalArea $medicalArea): Response
    {
        return $this->render('medical_area/show.html.twig', [
            'medicalArea' => $medicalArea
        ]);
    }
}
