<?php

namespace App\Controller;

use App\Entity\Functie;
use App\Form\FunctieType;
use App\Repository\FunctieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/functie")
 */
class FunctieController extends AbstractController
{
    /**
     * @Route("/", name="functie_index", methods={"GET"})
     */
    public function index(FunctieRepository $functieRepository): Response
    {
        return $this->render('functie/index.html.twig', [
            'functies' => $functieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="functie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $functie = new Functie();
        $form = $this->createForm(FunctieType::class, $functie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($functie);
            $entityManager->flush();

            return $this->redirectToRoute('functie_index');
        }

        return $this->render('functie/new.html.twig', [
            'functie' => $functie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="functie_show", methods={"GET"})
     */
    public function show(Functie $functie): Response
    {
        return $this->render('functie/show.html.twig', [
            'functie' => $functie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="functie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Functie $functie): Response
    {
        $form = $this->createForm(FunctieType::class, $functie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('functie_index', [
                'id' => $functie->getId(),
            ]);
        }

        return $this->render('functie/edit.html.twig', [
            'functie' => $functie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="functie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Functie $functie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$functie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($functie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('functie_index');
    }
}
