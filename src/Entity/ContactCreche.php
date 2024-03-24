<?php

namespace App\Entity;

use App\Repository\ContactCrecheRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ContactCrecheRepository::class)]
class ContactCreche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez entrer un nom.')]
    #[Assert\Length(
        min: 2,
        max: 40,
        minMessage: 'Le nom doit avoir au moins {{ limit }} caractères.',
        maxMessage: 'Le nom ne peut pas dépasser {{ limit }} caractères.'
    )]

    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez entrer un prénom.')]
    #[Assert\Length(
        min: 3,
        max: 30,
        minMessage: 'Le prénom doit avoir au moins {{ limit }} caractères.',
        maxMessage: 'Le prénom ne peut pas dépasser {{ limit }} caractères.'
    )]

    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email(
        message: "l'email {{ value }} n'est pas valid.",
    )]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez entrer votre message.')]
    #[Assert\Length(
        min: 5,
        max: 2500,
        minMessage: 'Le message doit avoir au moins {{ limit }} caractères.',
        maxMessage: 'Le message ne peut pas dépasser {{ limit }} caractères.'
    )]

    private ?string $message = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;


    #[ORM\ManyToOne(inversedBy: 'creche')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AddCreche $creche = null;

    #[ORM\OneToMany(targetEntity: AddCreche::class, mappedBy: 'pro', orphanRemoval: true)]
    private Collection $pro;


    public function __construct()
    {
        $this->setCreatedAt(new \DateTimeImmutable());
        $this->setStatus('pending');
        $this->pro = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

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

    public function getCreche(): ?AddCreche
    {
        return $this->creche;
    }

    public function setCreche(?AddCreche $creche): static
    {
        $this->creche = $creche;

        return $this;
    }

    /**
     * @return Collection<int, AddCreche>
     */
    public function getPro(): Collection
    {
        return $this->pro;
    }

    public function addPro(AddCreche $pro): static
    {
        if (!$this->pro->contains($pro)) {
            $this->pro->add($pro);
            $pro->setPro($this);
        }

        return $this;
    }

    public function removePro(AddCreche $pro): static
    {
        if ($this->pro->removeElement($pro)) {
            // set the owning side to null (unless already changed)
            if ($pro->getPro() === $this) {
                $pro->setPro(null);
            }
        }

        return $this;
    }
}