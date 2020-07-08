<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccController extends AbstractController
{
    /**
     * @Route("/", name="acc")
     */
    public function index()
    {
        return $this->render('acc/index.html.twig', [
            'controller_name' => 'AccController',
        ]);
    }
}
