<?php

namespace App\Controller;

use App\Repository\SoortRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(SoortRepository $soortRepository)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'soorten' => $soortRepository->findAll(),
        ]);
    }
}
