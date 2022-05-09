<?php

namespace App\Controller\Admin;

use App\Entity\SocialNetworks;
use App\Form\SocialNetworksType;
use App\Repository\SocialNetworksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/social/networks')]
class SocialNetworksController extends AbstractController
{
    #[Route('/', name: 'app_admin_social_networks_index', methods: ['GET'])]
    public function index(SocialNetworksRepository $socialNetworksRepository): Response
    {
        return $this->render('admin/social_networks/index.html.twig', [
            'social_networks' => $socialNetworksRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_social_networks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SocialNetworksRepository $socialNetworksRepository): Response
    {
        $socialNetwork = new SocialNetworks();
        $form = $this->createForm(SocialNetworksType::class, $socialNetwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $socialNetworksRepository->add($socialNetwork);
            return $this->redirectToRoute('app_admin_social_networks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/social_networks/new.html.twig', [
            'social_network' => $socialNetwork,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_social_networks_show', methods: ['GET'])]
    public function show(SocialNetworks $socialNetwork): Response
    {
        return $this->render('admin/social_networks/show.html.twig', [
            'social_network' => $socialNetwork,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_social_networks_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SocialNetworks $socialNetwork, SocialNetworksRepository $socialNetworksRepository): Response
    {
        $form = $this->createForm(SocialNetworksType::class, $socialNetwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $socialNetworksRepository->add($socialNetwork);
            return $this->redirectToRoute('app_admin_social_networks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/social_networks/edit.html.twig', [
            'social_network' => $socialNetwork,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_social_networks_delete', methods: ['POST'])]
    public function delete(Request $request, SocialNetworks $socialNetwork, SocialNetworksRepository $socialNetworksRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$socialNetwork->getId(), $request->request->get('_token'))) {
            $socialNetworksRepository->remove($socialNetwork);
        }

        return $this->redirectToRoute('app_admin_social_networks_index', [], Response::HTTP_SEE_OTHER);
    }
}
