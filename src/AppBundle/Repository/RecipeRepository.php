<?php
/**
 * Copyright (c) 18-06-2019 20:22, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use AppBundle\Entity\Province;
use AppBundle\Entity\Recipe;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class RecipeRepository
 * @package AppBundle\Repository
 */
class RecipeRepository {

    /**
     * @var EntityManagerInterface
     */
    protected $_em;

    /**
     * @var ObjectRepository
     */
    protected $_repository;

    /**
     * UserRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager) {
        $this->_em = $entityManager;
        $this->_repository = $this->_em->getRepository(Recipe::class);
    }

    /**
     * @param int $id
     * @return Recipe|null
     */
    public function findById(int $id): ?Recipe {
        return $this->_repository->find($id);
    }

    /**
     * @param Category $category
     * @return Recipe[]
     */
    public function findByCategory(Category $category): array {

        $query = $this->_em->createQueryBuilder()
            ->select("r")
            ->from("AppBundle:Recipe", "r")
            ->where("r.category is :category")
            ->setParameters([
                "category" => $category
            ])
            ->getQuery();

        return $query->getArrayResult();
    }

    /**
     * @param string $term
     * @return Recipe[]
     */
    public function searchBy(string $term): array {

        // Create open query to lookup recipe on given field
        $query = $this->_em->createQueryBuilder()
            ->select("r")
            ->from("AppBundle:Recipe", "r")
            ->where("r.title LIKE :term")
            ->orWhere("r.description LIKE :term")
            ->setParameters([
                "term" => "%$term%"
            ])
            ->getQuery();

        return $query->getArrayResult();
    }

    /**
     * @param string $term
     * @param Category $category
     * @param Province $province
     * @return Recipe[]
     */
    public function filterByFields(string $term, Category $category, Province $province) {

        // Create open query to lookup recipe on given field
        $query = $this->_em->createQueryBuilder()
            ->select("r")
            ->from("AppBundle:Recipe", "r")
            ->leftJoin("r.provinces", "p")
            ->where("r.title LIKE :term")
            ->orWhere("r.description LIKE :term")
            ->andWhere("r.category = :category")
            ->andWhere("p.id = :province")
            ->setParameters([
                "term" => "%$term%",
                "category" => $category,
                "province" => $province->getId()
            ])
            ->getQuery();

        return $query->getArrayResult();
    }
}