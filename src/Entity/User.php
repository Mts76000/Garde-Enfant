<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank]
    #[Assert\Email(
        message: "l'email {{ value }} n'est pas valid.",
    )]
    private ?string $email = null;  

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $adresse = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $ZIP = null;


    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\OneToMany(targetEntity: FullChild::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $fullChildren;

    #[ORM\OneToMany(targetEntity: RecupChild::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $user;

    #[ORM\OneToMany(targetEntity: AddCreche::class, mappedBy: 'user')]
    private Collection $users;


   
    public function __construct()
    {
        $this->setCreatedAt(new DateTimeImmutable());
        $this->setStatus(('new'));
        $this->fullChildren = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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



    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getZIP(): ?int
    {
        return $this->ZIP;
    }

    public function setZIP(int $ZIP): static
    {
        $this->ZIP = $ZIP;

        return $this;
    }

    /**
     * @return Collection<int, Child>
     */
    public function getChilds(): Collection
    {
        return $this->childs;
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

    /**
     * @return Collection<int, FullChild>
     */
    public function getFullChildren(): Collection
    {
        return $this->fullChildren;
    }

    public function addFullChild(FullChild $fullChild): static
    {
        if (!$this->fullChildren->contains($fullChild)) {
            $this->fullChildren->add($fullChild);
            $fullChild->setUser($this);
        }

        return $this;
    }

    public function removeFullChild(FullChild $fullChild): static
    {
        if ($this->fullChildren->removeElement($fullChild)) {
            // set the owning side to null (unless already changed)
            if ($fullChild->getUser() === $this) {
                $fullChild->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecupChild>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(RecupChild $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setUser($this);
        }

        return $this;
    }

    public function removeUser(RecupChild $user): static
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getUser() === $this) {
                $user->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AddCreche>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

}
