<?php

namespace App\Controller;

use App\Entity\Instruments;
use App\Form\InstrumentsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/instruments")
 */
class InstrumentsController extends AbstractController
{
    /**
     * @Route("/", name="instruments_index", methods="GET")
     */
    public function index(): Response
    {
        $instruments = $this->getDoctrine()
            ->getRepository(Instruments::class)
            ->findAll();

        return $this->render('instruments/index.html.twig', ['instruments' => $instruments]);
    }

    /**
     * @Route("/new", name="instruments_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $instrument = new Instruments();
        $form = $this->createForm(InstrumentsType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($instrument);
            $em->flush();

            return $this->redirectToRoute('instruments_index');
        }

        return $this->render('instruments/new.html.twig', [
            'instrument' => $instrument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idinstruments}", name="instruments_show", methods="GET")
     */
    public function show(Instruments $instrument): Response
    {
        return $this->render('instruments/show.html.twig', ['instrument' => $instrument]);
    }

    /**
     * @Route("/{idinstruments}/edit", name="instruments_edit", methods="GET|POST")
     */
    public function edit(Request $request, Instruments $instrument): Response
    {
        $form = $this->createForm(InstrumentsType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('instruments_edit', ['idinstruments' => $instrument->getIdinstruments()]);
        }

        return $this->render('instruments/edit.html.twig', [
            'instrument' => $instrument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idinstruments}", name="instruments_delete", methods="DELETE")
     */
    public function delete(Request $request, Instruments $instrument): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instrument->getIdinstruments(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($instrument);
            $em->flush();
        }

        return $this->redirectToRoute('instruments_index');
    }
}
