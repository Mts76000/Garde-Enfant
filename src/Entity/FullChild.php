<?php

namespace App\Entity;

use App\Repository\FullChildRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FullChildRepository::class)]
class FullChild
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le nom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le nom doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $nom = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le prenom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le prenom doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $age = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $genre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
     #[Assert\Length(
        min: 2,
        max: 500,
        minMessage: ' doit contenir au moins {{ limit }} caractères',
        maxMessage: ' doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $consigne_alimentaire = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 500,
        minMessage: ' doit contenir au moins {{ limit }} caractères',
        maxMessage: 'doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $traitement = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $vaccin = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank] 
    #[Assert\Length(
        min: 2,
        max: 500,
        minMessage: 'doit contenir au moins {{ limit }} caractères',
        maxMessage: 'doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $alergie = null;

    #[ORM\ManyToOne(inversedBy: 'fullChildren')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function __construct()
    {
        $this->setStatus('new');
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getConsigneAlimentaire(): ?string
    {
        return $this->consigne_alimentaire;
    }

    public function setConsigneAlimentaire(string $consigne_alimentaire): static
    {
        $this->consigne_alimentaire = $consigne_alimentaire;

        return $this;
    }

    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    public function setTraitement(string $traitement): static
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getVaccin(): ?int
    {
        return $this->vaccin;
    }

    public function setVaccin(int $vaccin): static
    {
        $this->vaccin = $vaccin;

        return $this;
    }

    public function getAlergie(): ?string
    {
        return $this->alergie;
    }

    public function setAlergie(string $alergie): static
    {
        $this->alergie = $alergie;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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
}
