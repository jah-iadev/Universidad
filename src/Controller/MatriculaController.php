<?php

namespace App\Controller;

use App\Entity\Matricula;
use App\Form\MatriculaType;
use App\Repository\MatriculaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/matricula')]
final class MatriculaController extends AbstractController
{
    #[Route(name: 'app_matricula_index', methods: ['GET'])]
    public function index(MatriculaRepository $matriculaRepository): Response
    {
        return $this->render('matricula/index.html.twig', [
            'matriculas' => $matriculaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_matricula_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $matricula = new Matricula();
        $form = $this->createForm(MatriculaType::class, $matricula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($matricula);
            $entityManager->flush();

            return $this->redirectToRoute('app_matricula_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('matricula/new.html.twig', [
            'matricula' => $matricula,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_matricula_show', methods: ['GET'])]
    public function show(Matricula $matricula): Response
    {
        return $this->render('matricula/show.html.twig', [
            'matricula' => $matricula,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_matricula_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Matricula $matricula, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MatriculaType::class, $matricula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_matricula_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('matricula/edit.html.twig', [
            'matricula' => $matricula,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_matricula_delete', methods: ['POST'])]
    public function delete(Request $request, Matricula $matricula, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matricula->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($matricula);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_matricula_index', [], Response::HTTP_SEE_OTHER);
    }
}
