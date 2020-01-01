<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NatureRepository")
 */
class Nature
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
     * @ORM\Column(type="string", length=255)
     */
    private $stat_aug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stat_down;

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

    public function getStatAug(): ?string
    {
        return $this->stat_aug;
    }

    public function setStatAug(string $stat_aug): self
    {
        $this->stat_aug = $stat_aug;

        return $this;
    }

    public function getStatDown(): ?string
    {
        return $this->stat_down;
    }

    public function setStatDown(string $stat_down): self
    {
        $this->stat_down = $stat_down;

        return $this;
    }
}
