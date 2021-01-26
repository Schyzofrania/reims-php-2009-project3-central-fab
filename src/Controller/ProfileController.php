<?php

namespace App\Controller;

use App\Form\ChangeEmailType;
use App\Form\ChangePasswordType;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $entityManager
        // ,
        // User $user
    ): Response {
    $user = $this->getUser();


    $formEmail = $this->createForm(ChangeEmailType::class, $user);
    $formEmail->handleRequest($request);

    if ($formEmail->isSubmitted() && $formEmail->isValid()) {
        $entityManager->flush();

        $this->addFlash('success', 'Votre courriel à bien été changé !');
    }


    $formPassword = $this->createForm(ChangePasswordType::class, $user);
    $formPassword->handleRequest($request);

    if ($formPassword->isSubmitted() && $formPassword->isValid()) {
        if ($passwordEncoder->isPasswordValid($user, $formPassword->get('oldPassword')->getData())) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $formPassword->get('plainPassword')->getData()
                )
            );
            $entityManager->flush();

            $this->addFlash('success', 'Votre mot de passe à bien été changé !');

            return $this->redirectToRoute('profile');
        } else {
            $formPassword->addError(new FormError('Ancien mot de passe incorrect'));
            $this->addFlash('danger', 'incorrect password');
        }
    }

    return $this->render('profile/index.html.twig', [
        'emailForm' => $formEmail->createView(),
        'passwordForm' => $formPassword->createView(),
        'user' => $user,
    ]);
    }
}
