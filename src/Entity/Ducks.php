<?php

namespace App\Entity;

use App\Repository\DucksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=DucksRepository::class)
 * @UniqueEntity(fields="email", message="Email déjà pris")
 * @UniqueEntity(fields="duckname", message="Duckname déjà pris")
 */
class Ducks implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $duckname;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Quack::class, mappedBy="ducks")
     */
    private $quacks;
    /**
     * @ORM\Column(type="array", length=255)
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $ProfilImage;




    public function __construct()
    {
        $this->Quack = new ArrayCollection();
        $this->quack = new ArrayCollection();
        $this->comment = new ArrayCollection();
        $this->quacks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDuckname(): ?string
    {
        return $this->duckname;
    }

    public function setDuckname(string $duckname): self
    {
        $this->duckname = $duckname;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getRoles()
    {
        return $this->roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->duckname;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return Collection|Quack[]
     */
    public function getQuacks(): Collection
    {
        return $this->quacks;
    }

    public function addQuack(Quack $quack): self
    {
        if (!$this->quacks->contains($quack)) {
            $this->quacks[] = $quack;
            $quack->setDucks($this);
        }

        return $this;
    }

    public function removeQuack(Quack $quack): self
    {
        if ($this->quacks->removeElement($quack)) {
            // set the owning side to null (unless already changed)
            if ($quack->getDucks() === $this) {
                $quack->setDucks(null);
            }
        }

        return $this;
    }

    public function getProfilImage(): ?string
    {
        return $this->ProfilImage;
    }

    public function setProfilImage(?string $ProfilImage): self
    {
        $this->ProfilImage = $ProfilImage;

        return $this;
    }




}
