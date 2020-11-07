<?php

namespace App\Entity;

use App\Repository\InformationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InformationRepository::class)
 */
class Information
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MobileNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;


    /**
     * @ORM\OneToOne(targetEntity=Person::class, inversedBy="information", cascade={"persist", "remove"})
     */
    private $person_information;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMobileNumber(): ?int
    {
        return $this->MobileNumber;
    }

    public function setMobileNumber(int $MobileNumber): self
    {
        $this->MobileNumber = $MobileNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getPersonInformation(): ?Person
    {
        return $this->person_information;
    }

    public function setPersonInformation(?Person $person_information): self
    {
        $this->person_information = $person_information;

        return $this;
    }
}
