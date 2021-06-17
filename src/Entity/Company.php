<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=100, maxMessage="erreur trop long")
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=14)
     * @Assert\Regex("/^[\d]{14}$/")
     */
    private string $siret;

    /**
     * @ORM\Column(type="string", length=9)
     * @Assert\Regex("/^[\d]{9}$/")
     */
    private string $siren;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(max=50, maxMessage="erreur trop long")
     */
    private string $naf;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100, maxMessage="erreur trop long")
     */
    private string $address;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type("\DateTimeInterface")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="company", cascade={"persist", "remove"})
     */
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getNaf(): ?string
    {
        return $this->naf;
    }

    public function setNaf(string $naf): self
    {
        $this->naf = $naf;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setCompany(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getCompany() !== $this) {
            $user->setCompany($this);
        }

        $this->user = $user;

        return $this;
    }
}
