<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    public function addRole(EntityManagerInterface $entityManager, int $userId): Response
    {
        // Recupera el usuario desde la base de datos
        $user = $entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            throw $this->createNotFoundException('No se encontró el usuario con id ' . $userId);
        }

        // Añadir un nuevo rol
        $roles = $user->getRoles();
        $roles[] = 'ROLE_ADMIN'; // Aquí puedes cambiar el rol que quieres añadir
        $user->setRoles(array_unique($roles)); // Asegúrate de que no haya roles duplicados

        // Guardar los cambios en la base de datos
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Rol añadido al usuario con éxito');
    }
}
