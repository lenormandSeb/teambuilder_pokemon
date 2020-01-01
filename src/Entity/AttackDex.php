<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttackDexRepository")
 */
class AttackDex
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="pokemon")
     */
    private $type_attaque;

    /**
     * @return Type
     */
    public function getTypeAttack(): ?Type
    {
        return $this->type_attaque;
    }

    public function setTypeAttack(?Type $type): self
    {
        $this->type_attaque = $type;

        return $this;
    }

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tm;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $power;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $accurate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pp;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $effet;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prob;

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

    public function getCategorie(): ?int
    {
        return $this->categorie;
    }

    public function setCategorie(?int $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(?int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getTM(): ?string
    {
        return $this->tm;
    }

    public function setTM(string $tm): self
    {
        $this->tm = $tm;

        return $this;
    }

    public function getAccurate(): ?int
    {
        return $this->accurate;
    }

    public function setAccurate(?int $accurate): self
    {
        $this->accurate = $accurate;

        return $this;
    }

    public function getPp(): ?int
    {
        return $this->pp;
    }

    public function setPp(?int $pp): self
    {
        $this->pp = $pp;

        return $this;
    }

    public function getEffet(): ?string
    {
        return $this->effet;
    }

    public function setEffet(?string $effet): self
    {
        $this->effet = $effet;

        return $this;
    }

    public function getProb(): ?int
    {
        return $this->prob;
    }

    public function setProb(?int $prob): self
    {
        $this->prob = $prob;

        return $this;
    }
}
