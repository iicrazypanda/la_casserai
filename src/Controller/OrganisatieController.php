<?php

namespace App\Controller;

use App\Entity\Organisatie;
use App\Form\OrganisatieType;
use App\Repository\OrganisatieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/organisatie")
 */
class OrganisatieController extends AbstractController
{
    /**
     * @Route("/", name="organisatie_index", methods={"GET"})
     */
    public function index(OrganisatieRepository $organisatieRepository): Response
    {
        return $this->render('organisatie/index.html.twig', [
            'organisaties' => $organisatieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="organisatie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $organisatie = new Organisatie();
        $form = $this->createForm(OrganisatieType::class, $organisatie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($organisatie);
            $entityManager->flush();

            return $this->redirectToRoute('organisatie_index');
        }

        return $this->render('organisatie/new.html.twig', [
            'organisatie' => $organisatie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="organisatie_show", methods={"GET"})
     */
    public function show(Organisatie $organisatie): Response
    {
        return $this->render('organisatie/show.html.twig', [
            'organisatie' => $organisatie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="organisatie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Organisatie $organisatie): Response
    {
        $form = $this->createForm(OrganisatieType::class, $organisatie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('organisatie_index', [
                'id' => $organisatie->getId(),
            ]);
        }

        return $this->render('organisatie/edit.html.twig', [
            'organisatie' => $organisatie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="organisatie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Organisatie $organisatie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$organisatie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($organisatie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('organisatie_index');
    }
}
