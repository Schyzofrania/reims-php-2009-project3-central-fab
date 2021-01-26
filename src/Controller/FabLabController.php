<?php

namespace App\Controller;

use App\Entity\Fablab;
use App\Form\FabLabType;
use App\Form\FabLab2Type;
use App\Repository\FablabRepository;
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
            return $this->redirectToRoute('fab_lab_step2', ['id' => $fablab->getId()]);
        }
        return $this->render('fab_lab/index.html.twig', [
            'form' => $form->createView(),
            'fablab' => $fablab
        ]);
    }

    /**
     * @Route("/{id}/fablab_step2", name="fab_lab_step2")
     */
    public function new2(Request $request, Fablab $fablab): Response
    {
        $form = $this->createForm(FabLab2Type::class, $fablab);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $fablab->setAddress($form->get('address')->getData());
            $fablab->setSchedule($form->get('schedule')->getData());
            $fablab->setMail($form->get('mail')->getData());
            $fablab->setPhone($form->get('phone')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fablab);
            $entityManager->flush();
            return $this->redirectToRoute('map');
        }
        return $this->render('fab_lab/step2.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
