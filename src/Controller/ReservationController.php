<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\EtatSearch;
use App\Entity\Client;
use App\Form\EtatSearchType;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @Route("/reservation")
 */
class ReservationController extends AbstractController
{
    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/", name="reservation_index")
     */
    public function index(Request $request)
    {
        
        $etatSearch = new EtatSearch();
        $form = $this->createForm(EtatSearchType::class,$etatSearch);
        $form->handleRequest($request);
        $reservations= $this->getDoctrine()->getRepository(Reservation::class)->findAll();
       
        if($form->isSubmitted() && $form->isValid()) {
            $etat = $etatSearch->getEtat();
            if ($etat!="")
          
            $reservations= $this->getDoctrine()->getRepository(Reservation::class)->findBy(['etat' => $etat] );
            else
            $reservations= $this->getDoctrine()->getRepository(Reservation::class)->findAll();
            }
            return $this->render('reservation/index.html.twig',[ 'form' =>$form->createView(), 'reservations' => $reservations]);        
    }
  
    

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="reservation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="reservation_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="reservation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="reservation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }
}
