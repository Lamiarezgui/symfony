<?php
namespace App\Entity;
class EtatSearch
{
 private $etat;
 public function getEtat(): ?string
 {
 return $this->etat;
 }
 public function setEtat(string $etat): self
 {
 $this->etat = $etat;
 return $this;
 }
}
