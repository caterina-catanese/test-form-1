<?php

namespace App\Entity;

use App\Repository\DocumentiNewRepository;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentiNewRepository::class)]
class DocumentiNew
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titolo_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $yes = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descrizione = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_create = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_update = null;

    #[ORM\ManyToMany(targetEntity: user::class, inversedBy: 'documentiNews')]
    private Collection $id_utente_associato;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pippo = null;

    #[ORM\Column(length: 255)]
    private ?string $pluto = null;

    public function __construct()
    {
        $this->id_utente_associato = new ArrayCollection();
        $this->date_create = Carbon::now();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitolo2(): ?string
    {
        return $this->titolo_2;
    }

    public function setTitolo2(string $titolo_2): self
    {
        $this->titolo_2 = $titolo_2;

        return $this;
    }

    public function getYes(): ?string
    {
        return $this->yes;
    }

    public function setYes(string $yes): self
    {
        $this->yes = $yes;

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

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->date_create;
    }

    public function setDateCreate(\DateTimeInterface $date_create): self
    {
        $this->date_create = $date_create;

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

    /**
     * @return Collection<int, user>
     */
    public function getIdUtenteAssociato(): Collection
    {
        return $this->id_utente_associato;
    }

    public function addIdUtenteAssociato(user $idUtenteAssociato): self
    {
        if (!$this->id_utente_associato->contains($idUtenteAssociato)) {
            $this->id_utente_associato->add($idUtenteAssociato);
        }

        return $this;
    }

    public function removeIdUtenteAssociato(user $idUtenteAssociato): self
    {
        $this->id_utente_associato->removeElement($idUtenteAssociato);

        return $this;
    }

    public function getPippo(): ?string
    {
        return $this->pippo;
    }

    public function setPippo(?string $pippo): self
    {
        $this->pippo = $pippo;

        return $this;
    }

    public function getPluto(): ?string
    {
        return $this->pluto;
    }

    public function setPluto(string $pluto): self
    {
        $this->pluto = $pluto;

        return $this;
    }
}
