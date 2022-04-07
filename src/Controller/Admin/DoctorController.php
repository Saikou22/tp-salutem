<?php

namespace App\Controller\Admin;

use App\Entity\Doctor;
use App\Form\DoctorType;
use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/doctor')]
class DoctorController extends AbstractController
{
    #[Route('/', name: 'app_admin_doctor_index', methods: ['GET'])]
    public function index(DoctorRepository $doctorRepository): Response
    {
        return $this->render('admin/doctor/index.html.twig', [
            'doctors' => $doctorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_doctor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DoctorRepository $doctorRepository): Response
    {
        $doctor = new Doctor();
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctorRepository->add($doctor);
            return $this->redirectToRoute('app_admin_doctor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/doctor/new.html.twig', [
            'doctor' => $doctor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_doctor_show', methods: ['GET'])]
    public function show(Doctor $doctor): Response
    {
        return $this->render('admin/doctor/show.html.twig', [
            'doctor' => $doctor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_doctor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Doctor $doctor, DoctorRepository $doctorRepository): Response
    {
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctorRepository->add($doctor);
            return $this->redirectToRoute('app_admin_doctor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/doctor/edit.html.twig', [
            'doctor' => $doctor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_doctor_delete', methods: ['POST'])]
    public function delete(Request $request, Doctor $doctor, DoctorRepository $doctorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doctor->getId(), $request->request->get('_token'))) {
            $doctorRepository->remove($doctor);
        }

        return $this->redirectToRoute('app_admin_doctor_index', [], Response::HTTP_SEE_OTHER);
    }
}
