<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use App\Entity\Client;
/**
 * @ORM\Entity(repositoryClass=App\Repository\ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_r;

    /**
     * @ORM\Column(type="string", length=254)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="reservations")
     */
    private $id_cli;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="reservations")
     */
    private $id_service;


   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateR(): ?\DateTimeInterface
    {
        return $this->date_r;
    }

    public function setDateR(\DateTimeInterface $date_r): self
    {
        $this->date_r = $date_r;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getIdCli(): ?client
    {
        return $this->id_cli;
    }

    public function setIdCli(?client $id_cli): self
    {
        $this->id_cli = $id_cli;

        return $this;
    }

    public function getIdService(): ?service
    {
        return $this->id_service;
    }

    public function setIdService(?service $id_service): self
    {
        $this->id_service = $id_service;

        return $this;
    }
 
   
   
 
    
}
