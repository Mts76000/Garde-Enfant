<?php

namespace App\Entity;

use App\Repository\ProTimeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProTimeRepository::class)]
class ProTime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $jour = null;


    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $heure_debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $heure_fin = null;

    #[ORM\ManyToOne(inversedBy: 'pros')]
    private ?AddCreche $pro = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getIdPro(): ?int
    {
        return $this->id_pro;
    }

    public function setIdPro(?int $id_pro): static
    {
        $this->id_pro = $id_pro;

        return $this;
    }

    public function getJour(): ?array

    {
        return $this->jour;
    }

    public function setJour(?array $jour): static
    {
        $this->jour = $jour;

        return $this;
    }
    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heure_debut;
    }

    public function setHeureDebut(?\DateTimeInterface $heure_debut): static
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heure_fin;
    }

    public function setHeureFin(?\DateTimeInterface $heure_fin): static
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }

    public function getPro(): ?AddCreche
    {
        return $this->pro;
    }

    public function setPro(?AddCreche $pro): static
    {
        $this->pro = $pro;

        return $this;
    }
}
