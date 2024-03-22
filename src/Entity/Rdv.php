<?php

namespace App\Entity;

use App\Repository\RdvRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RdvRepository::class)]
class Rdv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;



    #[ORM\ManyToOne(inversedBy: 'child')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FullChild $child = null;

    #[ORM\ManyToOne(inversedBy: 'pro')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AddCreche $pro = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getIdChild(): ?FullChild
    {
        return $this->child;
    }

    public function setIdChild(?FullChild $child): static
    {
        $this->child = $child;

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
