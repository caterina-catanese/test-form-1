<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Documenti::class, mappedBy: 'utenti')]
    private Collection $documentis;

    #[ORM\ManyToMany(targetEntity: DocumentiNew::class, mappedBy: 'id_utente_associato')]
    private Collection $documentiNews;

    public function __construct()
    {
        $this->documentis = new ArrayCollection();
        $this->documentiNews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Documenti>
     */
    public function getDocumentis(): Collection
    {
        return $this->documentis;
    }

    public function addDocumenti(Documenti $documenti): self
    {
        if (!$this->documentis->contains($documenti)) {
            $this->documentis->add($documenti);
            $documenti->addUtenti($this);
        }

        return $this;
    }

    public function removeDocumenti(Documenti $documenti): self
    {
        if ($this->documentis->removeElement($documenti)) {
            $documenti->removeUtenti($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, DocumentiNew>
     */
    public function getDocumentiNews(): Collection
    {
        return $this->documentiNews;
    }

    public function addDocumentiNews(DocumentiNew $documentiNews): self
    {
        if (!$this->documentiNews->contains($documentiNews)) {
            $this->documentiNews->add($documentiNews);
            $documentiNews->addIdUtenteAssociato($this);
        }

        return $this;
    }

    public function removeDocumentiNews(DocumentiNew $documentiNews): self
    {
        if ($this->documentiNews->removeElement($documentiNews)) {
            $documentiNews->removeIdUtenteAssociato($this);
        }

        return $this;
    }
}
