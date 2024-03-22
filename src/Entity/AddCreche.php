<?php

namespace App\Entity;

use App\Repository\AddCrecheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AddCrecheRepository::class)]
class AddCreche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_user = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le nom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le nom doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 14)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 9,
        max: 14,
        minMessage: 'Le siret doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le siret doit contenir au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: "/^\d+$/",
        message: "Ce champ ne doit contenir que des chiffres"
    )]
    private ?string $siret = null;

    #[ORM\Column(length: 6)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 1,
        max: 6,
        minMessage: 'Le tarif doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le tarif doit contenir au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
    pattern: "/^\d+[\.,]?\d*$/",
    message: "Ce champ ne doit contenir que des chiffres, des points ou des virgules"
    )]
    private ?string $tarif = null;

    #[ORM\Column(length: 4)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 1,
        max: 4,
        minMessage: 'Le nombre de place doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le nombre de place doit contenir au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: "/^\d+$/",
        message: "Ce champ ne doit contenir que des chiffres"
    )]
    private ?string $maxEnfant = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'L\'adresse doit contenir au moins {{ limit }} caractères',
        maxMessage: 'L\'adresse doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email(
        message: 'Veuillez entrer une adresse mail valide'
    )]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'L\'email doit contenir au moins {{ limit }} caractères',
        maxMessage: 'L\'email doit contenir au maximum {{ limit }} caractères',
    )]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le numéro de telephone doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le numéro de telephone doit contenir au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: "/^\d+$/",
        message: "Ce champ ne doit contenir que des chiffres"
    )]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        minMessage: 'Veuillez uploader un document pdf',
     )]
    private ?string $agrement = null;

    #[ORM\Column]
    private ?string $status = null;

    #[ORM\Column]
    #[Assert\DateTime]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    #[Assert\DateTime]
    private ?\DateTimeImmutable $modified_at = null;

    #[ORM\OneToMany(targetEntity: Rdv::class, mappedBy: 'pro', orphanRemoval: true)]
    private Collection $pro;

    public function __construct()
    {
        $this->pro = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id_user = $id;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(?int $id_user): static
    {
        $this->id_user = $id_user;

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

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }


    public function getTarif(): ?string
    {
        return $this->tarif;
    }

    public function setTarif(string $tarif): static
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getMaxEnfant(): ?string
    {
        return $this->maxEnfant;
    }

    public function setMaxEnfant(?string $maxEnfant): void
    {
        $this->maxEnfant = $maxEnfant;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->modified_at;
    }

    public function setModifiedAt(?\DateTimeImmutable $modified_at): static
    {
        $this->modified_at = $modified_at;

        return $this;
    }


    public function getBrochureFilename(): ?string
    {
        return $this->agrement;
    }
    public function setBrochureFilename(string $brochureFilename): static
    {
        $this->agrement = $brochureFilename;

        return $this;
    }


    /**
     * @return Collection<int, rdv>
     */
    public function getPro(): Collection

    {
        return $this->pro;
    }

    public function addPro(rdv $pro): static
    {
        if (!$this->pro->contains($pro)) {
            $this->pro->add($pro);
            $pro->setPro($this);
        }


        return $this;
    }


    public function removePro(rdv $pro): static
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
