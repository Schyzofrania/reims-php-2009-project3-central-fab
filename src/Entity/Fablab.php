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
     * @ORM\Column(type="string", length=14)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $schedule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

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

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): ?self
    {
        $this->address = $address;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(?string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

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
