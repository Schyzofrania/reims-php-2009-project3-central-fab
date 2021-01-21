<?php

namespace App\Controller;

use App\Form\ChangeEmailType;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $formEmail = $this->createForm(ChangeEmailType::class, $user);
        $formEmail->handleRequest($request);

        $formPassword = $this->createForm(ChangePasswordType::class, $user);
        $formPassword->handleRequest($request);

        if ($formEmail->isSubmitted() && $formEmail->isValid()) {
            $entityManager->flush();
        }

        if ($formPassword->isSubmitted() && $formPassword->isValid()) {
            $entityManager->flush();
        }


        return $this->render('profile/index.html.twig', [
            'emailForm' => $formEmail->createView(),
            'passwordForm' => $formPassword->createView(),
        ]);
    }
}
