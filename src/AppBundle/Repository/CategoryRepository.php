<?php
/**
 * Copyright (c) 18-06-2019 21:8, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CategoryRepository
 * @package AppBundle\Repository
 */
class CategoryRepository {

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
        $this->_repository = $this->_em->getRepository(Category::class);
    }

    /**
     * @param int $id
     * @return Category|null
     */
    public function findById(int $id): ?Category {
        return $this->_repository->find($id);
    }

    /**
     * @return array
     */
    public function findAll() {
        return $this->_repository->findAll();
    }
}