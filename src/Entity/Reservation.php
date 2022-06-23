<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
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
    private $room;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user;

    /**
     * @ORM\Column(type="time")
     */
    private $CheckInDate;

    /**
     * @ORM\Column(type="time")
     */
    private $CheckOutDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoom(): ?int
    {
        return $this->room;
    }

    public function setRoom(int $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCheckInDate(): ?\DateTimeInterface
    {
        return $this->CheckInDate;
    }

    public function setCheckInDate(\DateTimeInterface $CheckInDate): self
    {
        $this->CheckInDate = $CheckInDate;

        return $this;
    }

    public function getCheckOutDate(): ?\DateTimeInterface
    {
        return $this->CheckOutDate;
    }

    public function setCheckOutDate(\DateTimeInterface $CheckOutDate): self
    {
        $this->CheckOutDate = $CheckOutDate;

        return $this;
    }
}
