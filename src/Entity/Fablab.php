<?php

namespace App\Entity;

use App\Repository\FablabRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FablabRepository::class)
 */
class Fablab
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="text")
     */
    private $adress;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="reservations")
     */
    private $reservation;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="creations")
     * @ORM\JoinTable(name="creation")
     */
    private $creation;

    public function __construct()
    {
        $this->reservation = new ArrayCollection();
        $this->creation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getReservation(): Collection
    {
        return $this->reservation;
    }

    public function addReservation(User $reservation): self
    {
        if (!$this->reservation->contains($reservation)) {
            $this->reservation[] = $reservation;
        }

        return $this;
    }

    public function removeReservation(User $reservation): self
    {
        $this->reservation->removeElement($reservation);

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getCreation(): Collection
    {
        return $this->creation;
    }

    public function addCreation(User $creation): self
    {
        if (!$this->creation->contains($creation)) {
            $this->creation[] = $creation;
        }

        return $this;
    }

    public function removeCreation(User $creation): self
    {
        $this->creation->removeElement($creation);

        return $this;
    }
}
