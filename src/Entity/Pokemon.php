<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PokemonRepository")
 */
class Pokemon
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
     * @ORM\Column(type="integer")
     */
    private $num_dex;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="pokemon")
     * @ORM\JoinTable(name="type_one_id")
     */
    private $type_one;

    /**
     * @return Type
     */
    public function getTypeOne(): ?Type
    {
        return $this->type_one;
    }

    public function setTypeOne(?Type $type): self
    {
        $this->type_one = $type;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="pokemon")
     * @ORM\JoinTable(name="type_two_id")
     */
    private $type_two;

    /**
     * @return Type
     */
    public function getTypeTwo(): ?Type
    {
        return $this->type_two;
    }

    public function setTypeTwo(?Type $type): self
    {
        $this->type_two = $type;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Talent", inversedBy="pokemon")
     * @ORM\JoinTable(name="talent_one_id", joinColumns={@ORM\JoinColumn(name="talent_one_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id", referencedColumnName="talent_one_id")}
     *      )
     */
    private $talent_one;

    /**
     * @return Talent
     */
    public function getTalentOne(): ?Talent
    {
        return $this->talent_one;
    }

    public function setTalentOne(?Talent $talent): self
    {
        $this->talent_one = $talent;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Talent", inversedBy="pokemon")
     * @ORM\JoinTable(name="talent_two_id")
     */
    private $talent_two;

    /**
     * @return Talent
     */
    public function getTalentTwo(): ?Talent
    {
        return $this->talent_two;
    }

    public function setTalentTwo(?Talent $talent): self
    {
        $this->talent_two = $talent;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Talent", inversedBy="pokemon")
     * @ORM\JoinTable(name="talent_hide_id")
     */
    private $talent_hide;

    /**
     * @return Talent
     */
    public function getTalentHide(): ?Talent
    {
        return $this->talent_hide;
    }

    public function setTalentHide(?Talent $talent): self
    {
        $this->talent_hide = $talent;

        return $this;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $hp;

    /**
     * @ORM\Column(type="integer")
     */
    private $attack;

    /**
     * @ORM\Column(type="integer")
     */
    private $defense;

    /**
     * @ORM\Column(type="integer")
     */
    private $spe_attack;

    /**
     * @ORM\Column(type="integer")
     */
    private $spe_defense;

    /**
     * @ORM\Column(type="integer")
     */
    private $speed;

    /**
     * @ORM\Column(type="integer")
     */
    private $generation;

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

    public function getNumDex(): ?int
    {
        return $this->num_dex;
    }

    public function setNumDex(int $num_dex): self
    {
        $this->num_dex = $num_dex;

        return $this;
    }


    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(int $attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getSpeAttack(): ?int
    {
        return $this->spe_attack;
    }

    public function setSpeAttack(int $spe_attack): self
    {
        $this->spe_attack = $spe_attack;

        return $this;
    }

    public function getSpeDefense(): ?int
    {
        return $this->spe_defense;
    }

    public function setSpeDefense(int $spe_defense): self
    {
        $this->spe_defense = $spe_defense;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getGeneration(): ?int
    {
        return $this->generation;
    }

    public function setGeneration(int $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function __toArray()
    {
        return ['name' => $this->name, 'num_dex' => $this->num_dex, 'type' => ["type1" => $this->getTypeOne(), "type2" => $this->getTypeTwo()]];
    }

    // public function getBackgroundColor(string $value): ?string
    // {
    //     if (property_exists($this, $value))
    //     {
    //         $val = (0.3921 * intval($this->$value));
    //         switch ($val) {
    //             case ($val < 33):
    //                 return 'red';
    //             case ($val < 66):
    //                 return 'green';
    //             default:
    //                 return 'blue';
    //         }
    //     }
    //     return 0;
    // }

    // public function getTotalBaseStats(): ?int
    // {
    //     return ($this->hp + $this->attack + $this->defense + $this->spe_attack + $this->spe_defense + $this->speed);
    // }

    // public function getFaiblesse()
    // {
    //     if ($this->type_one)
    //     {
    //         $val = $this->getFaiblesseType($this->type_one->getId());
    //         if($this->type_two)
    //         {
    //             $v = [];
    //             $type2 = $this->getFaiblesseType($this->type_two->getId());
    //             $t2 = explode(';', $type2);
    //             $t1 = explode(';', $val);
    //             for ($i = 0; $i < 18; $i++){
    //                 $calc = (floatval($t1[$i]) * floatval($t2[$i]));
    //                 array_push($v, $calc);
    //             }
    //             //dump(implode(',',$v));
    //             return implode(';',$v);
    //         }
    //     }
    //     return $val;
    // }

    // public function getFaiblesseType($search)
    // {
    //     switch ($search)
    //     {
    //         case 16:
    //             // Tenebres
    //             $val = '1;2;1;1;1;2;1;1;2;1;1;1;0;1;1;0.5;0.5;1';
    //         break;
    //         case 3:
    //             // Feu
    //             $val = '0.5;1;1;2;1;0.5;0.5;0.5;0.5;1;0.5;1;1;2;2;1;1;1';
    //         break;
    //         case 4:
    //             // EAU
    //             $val = '0.5;1;1;0.5;2;1;0.5;0.5;1;1;2;1;1;1;1;1;1;1';
    //         break;
    //         case 8:
    //             // Poison
    //             $val = '1;0.5;1;1;1;0.5;1;1;0.5;1;0.5;0.5;2;1;2;1;1;1';
    //         break;
    //         case 18:
    //             // Fée
    //             $val = '2;0.5;0;1;1;1;1;1;0.5;1;1;2;1;1;1;1;0.5;1';
    //         break;
    //         case 17:
    //             // Acier
    //             $val = '0.5;2;0.5;1;1;0.5;2;0.5;0.5;0.5;0.5;0;0.5;0.5;2;1;1;0.5';
    //         break;
    //         case 2:
    //             // Plante
    //             $val = '1;1;1;0.5;0.5;1;2;2;2;1;0.5;2;1;1;0.5;1;1;2';
    //         break;
    //         case 14:
    //             // Spectre
    //             $val = '1;0;1;1;1;1;1;1;0.5;0;1;0.5;1;1;1;2;2;1';
    //         break;
    //         case 15:
    //             // Dragon
    //             $val = '1;1;2;0.5;0.5;2;0.5;2;1;1;0.5;1;1;1;1;1;1;1';
    //         break;
    //         case 5:
    //             // Elek
    //             $val = '0.5;1;1;1;0.5;1;1;1;1;1;1;1;1;1;2;1;1;0.5';
    //         break;
    //         case 12:
    //             // Insecte
    //             $val = '1;0.5;1;1;1;1;2;1;1;1;0.5;1;1;2;0.5;1;1;2';
    //         break;
    //         case 6:
    //             // Glace
    //             $val = '2;2;1;1;1;1;2;0.5;1;1;1;1;1;2;1;1;1;1';
    //         break;
    //         case 13:
    //             // Roche
    //             $val = '2;2;1;2;1;1;0.5;1;1;0.5;2;0.5;1;1;2;1;1;0.5';
    //         break;
    //         case 9:
    //             // Sol
    //             $val = '1;1;1;2;0;1;1;2;1;1;2;0.5;1;0.5;1;1;1;1';
    //         break;
    //         case 10:
    //             // Vol
    //             $val = '1;0.5;1;1;2;1;1;2;0.5;1;0.5;1;1;2;0;1;1;1';
    //         break;
    //         case 7:
    //             // Combat
    //             $val = '1;1;1;1;1;2;1;1;0.5;1;1;1;2;0.5;1;1;0.5;2';
    //         break;
    //         case 11:
    //             // Psy
    //             $val = '1;0.5;1;1;1;1;1;1;2;1;1;1;0.5;1;1;2;2;1';
    //         break;
    //         case 1:
    //             // Normal
    //             $val = '1;2;1;1;1;1;1;1;1;1;1;1;1;1;1;0;1;1';
    //         break;
    //         default:
    //             $val = 'false';
    //     }

    //     return $val;
    // }
}
