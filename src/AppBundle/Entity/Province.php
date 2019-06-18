<?php
/**
 * Copyright (c) 18-06-2019 19:21, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Province
 * @package AppBundle\Entity
 * @ORM\Entity
 */
class Province {

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Recipe", inversedBy="provinces")
     * @ORM\JoinTable(name="province_recipe")
     */
    private $recipes;

    public function __construct() {
        $this->recipes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getRecipes(): ArrayCollection {
        return $this->recipes;
    }

    /**
     * @param ArrayCollection $recipes
     */
    public function setRecipes(ArrayCollection $recipes): void {
        $this->recipes = $recipes;
    }

    /**
     * @param Recipe $recipe
     */
    public function addRecipe(Recipe $recipe): void {
        $this->recipes->add($recipe);
    }

    /**
     * @param Recipe $recipe
     */
    public function removeRecipe(Recipe $recipe): void {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
        }
    }
}