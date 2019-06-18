<?php
/**
 * Copyright (c) 18-06-2019 19:21, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Recipe
 * @package AppBundle\Entity
 * @ORM\Entity
 */
class Recipe {

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", length=65535)
     */
    private $description;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="time", nullable=true)
     */
    private $prepTime;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="time", nullable=true)
     */
    private $waitTime;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", length=2)
     */
    private $servings;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Province", mappedBy="recipes")
     */
    private $provinces;

    /**
     * Recipe constructor.
     */
    public function __construct() {
        $this->provinces = new ArrayCollection();
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
     * @return Category
     */
    public function getCategory(): Category {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void {
        $this->description = $description;
    }

    /**
     * @return DateTime
     */
    public function getPrepTime(): ?DateTime {
        return $this->prepTime;
    }

    /**
     * @param DateTime $prepTime
     */
    public function setPrepTime(DateTime $prepTime): void {
        $this->prepTime = $prepTime;
    }

    /**
     * @return DateTime
     */
    public function getWaitTime(): ?DateTime {
        return $this->waitTime;
    }

    /**
     * @param DateTime $waitTime
     */
    public function setWaitTime(DateTime $waitTime): void {
        $this->waitTime = $waitTime;
    }

    /**
     * @return int
     */
    public function getServings(): int {
        return $this->servings;
    }

    /**
     * @param int $servings
     */
    public function setServings(int $servings): void {
        $this->servings = $servings;
    }
}