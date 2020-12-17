<?php

namespace App\Controller;

use App\Entity\Fablab;
use App\Form\FabLabType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FabLabController extends AbstractController
{
    /**
     * @Route("/fablab", name="fab_lab")
     */
    public function new(Request $request): Response
    {
        $fablab = new Fablab();
        $form = $this->createForm(FabLabType::class, $fablab);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fablab);
            $entityManager->flush();
            return $this->redirectToRoute('map');
        }
        return $this->render('fab_lab/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
