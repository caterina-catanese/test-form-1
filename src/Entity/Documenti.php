<?php

namespace App\Entity;

use App\Repository\DocumentiRepository;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentiRepository::class)]
class Documenti
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titolo = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descrizione = null;

    #[ORM\ManyToMany(targetEntity: user::class, inversedBy: 'documentis')]
    private Collection $utenti;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $data_create = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_update = null;

    public function __construct()
    {
        $this->utenti = new ArrayCollection();
        $this->data_create = Carbon::now();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitolo(): ?string
    {
        return $this->titolo;
    }

    public function setTitolo(string $titolo): self
    {
        $this->titolo = $titolo;

        return $this;
    }

    public function getDescrizione(): ?string
    {
        return $this->descrizione;
    }

    public function setDescrizione(string $descrizione): self
    {
        $this->descrizione = $descrizione;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUtenti(): Collection
    {
        return $this->utenti;
    }

    public function addUtenti(user $utenti): self
    {
        if (!$this->utenti->contains($utenti)) {
            $this->utenti->add($utenti);
        }

        return $this;
    }

    public function removeUtenti(user $utenti): self
    {
        $this->utenti->removeElement($utenti);

        return $this;
    }

    public function getDataCreate(): ?\DateTimeInterface
    {
        return $this->data_create;
    }

    public function setDataCreate(\DateTimeInterface $data_create): self
    {
        $this->data_create = $data_create;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->date_update;
    }

    public function setDateUpdate(\DateTimeInterface $date_update): self
    {
        $this->date_update = $date_update;

        return $this;
    }
}
