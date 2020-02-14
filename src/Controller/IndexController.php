<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('index/index.html.twig');
    }


     /**
     * @Route("/create-user", name="create_user")
     */
    public function createUser(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {
        $user = new User;
        $form = $this->createForm(CreateUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $encryptedUserPassword = $userPasswordEncoderInterface->encodePassword($user, $user->getPassword());
            $user->setPassword($encryptedUserPassword);
            $em->persist($user);
            $em->flush();
        }


        return $this->render('index/createUser.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
