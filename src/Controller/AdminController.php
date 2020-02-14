<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function admin()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    // /**
    //  * @Route("/users", name="users")
    //  */
    // public function users(UserRepository $userRepository)
    // {
    //     $users = $userRepository->findAll();
    //     return $this->render('admin/users.html.twig', [
    //         'users' => $users,
    //     ]);
    // }
}
