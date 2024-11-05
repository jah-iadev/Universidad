<?php

namespace App\Controller;

use App\Entity\Aula;
use App\Form\AulaType;
use App\Repository\AulaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/aula')]
final class AulaController extends AbstractController
{
    #[Route( name: 'app_aula_index', methods: ['GET'])]
    public function index(AulaRepository $aulaRepository): Response
    {
        return $this->render('aula/index.html.twig', [
            'aulas' => $aulaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_aula_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $aula = new Aula();
        $form = $this->createForm(AulaType::class, $aula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($aula);
            $entityManager->flush();

            return $this->redirectToRoute('app_aula_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aula/new.html.twig', [
            'aula' => $aula,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_aula_show', methods: ['GET'])]
    public function show(Aula $aula): Response
    {
        return $this->render('aula/show.html.twig', [
            'aula' => $aula,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_aula_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Aula $aula, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AulaType::class, $aula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_aula_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('aula/edit.html.twig', [
            'aula' => $aula,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_aula_delete', methods: ['POST'])]
    public function delete(Request $request, Aula $aula, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aula->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($aula);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_aula_index', [], Response::HTTP_SEE_OTHER);
    }
}
