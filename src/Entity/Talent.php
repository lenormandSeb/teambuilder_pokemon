<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TalentRepository")
 */
class Talent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $effetCombat;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pokemon", mappedBy="type_one")
     */
    private $pokemon;

    public function __construct()
    {
        $this->pokemon = new ArrayCollection();
    }

    /**
     * @return Collection|Pokemon[]
     */
    public function getPokemon(): Collection
    {
        return $this->pokemon;
    }

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

    public function getEffetCombat(): ?string
    {
        return $this->effetCombat;
    }

    public function setEffetCombat(string $effetCombat): self
    {
        $this->effetCombat = $effetCombat;

        return $this;
    }
}
