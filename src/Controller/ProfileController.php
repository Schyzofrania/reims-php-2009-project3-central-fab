<?php

namespace App\Controller;

use App\Entity\Fablab;
use App\Form\ChangeEmailType;
use App\Form\ChangePasswordType;
use App\Repository\UserRepository;
use App\Repository\FablabRepository;
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
        EntityManagerInterface $entityManager,
        FablabRepository $fablab,
        UserRepository $user
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
                $this->addFlash('danger', 'Votre mot de passe est incorrect.');
            }
        }

        if($fablab->findBy(['user' => $user->getId()])) {
            $fablab = $fablab->findBy(['user' => $user->getId()]);
        } else {
            $fablab = null;
        }

        return $this->render('profile/index.html.twig', [
            'emailForm' => $formEmail->createView(),
            'passwordForm' => $formPassword->createView(),
            'user' => $user,
            'fablab' => $fablab,
        ]);
    }
}
