<?php

namespace App\Controller;

use App\Entity\Kamer;
use App\Entity\Reservering;
use App\Form\KamerType;
use App\Repository\KamerRepository;
use App\Repository\SoortRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kamer")
 */
class KamerController extends AbstractController
{
    /**
     * @Route("/", name="kamer_index", methods={"GET"})
     */
    public function index(KamerRepository $kamerRepository): Response
    {
        return $this->render('kamer/index.html.twig', [
            'kamers' => $kamerRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="kamer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $kamer = new Kamer();
        $form = $this->createForm(KamerType::class, $kamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kamer);
            $entityManager->flush();

            return $this->redirectToRoute('kamer_index');
        }

        return $this->render('kamer/new.html.twig', [
            'kamer' => $kamer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kamer_show", methods={"GET"})
     */
    public function show(Kamer $kamer): Response
    {
        return $this->render('kamer/show.html.twig', [
            'kamer' => $kamer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="kamer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Kamer $kamer): Response
    {
        $form = $this->createForm(KamerType::class, $kamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kamer_index', [
                'id' => $kamer->getId(),
            ]);
        }

        return $this->render('kamer/edit.html.twig', [
            'kamer' => $kamer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kamer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Kamer $kamer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kamer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kamer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kamer_index');
    }

    /**
     * @Route("/check", name="kamer_check", methods={"POST"})
     */
    public function checkDate(SoortRepository $soortRepository)
    {
        $BeginDate = $_POST["begin_datum"];
        $EndDate = $_POST["eind_datum"];

        $reservering = $this->getDoctrine()
            ->getRepository(Reservering::class)
            ->getBetween(array($BeginDate, $EndDate));

        $input = array();
        for ($x = 0; $x < count($reservering); $x++) {
            array_push($input, "'".$reservering[$x][1]."'");
        }

        $available = $this->getDoctrine()
            ->getRepository(Kamer::class)
            ->notIn($input);

        return $this->render('kamer/default_index.html.twig', [
            'kamers' => $available,
            'soorten' => $soortRepository->findAll(),
        ]);
    }

}
