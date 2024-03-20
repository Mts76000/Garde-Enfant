<?php

namespace App\Entity;

use App\Repository\RecupChildRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecupChildRepository::class)]
class RecupChild
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
        minMessage: 'Le prenom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le prenom doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le nom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le nom doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $firstName = null;

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


    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

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
