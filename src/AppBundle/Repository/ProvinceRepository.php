<?php
/**
 * Copyright (c) 18-06-2019 21:8, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Province;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ProvinceRepository
 * @package AppBundle\Repository
 */
class ProvinceRepository {

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
        $this->_repository = $this->_em->getRepository(Province::class);
    }

    /**
     * @param int $id
     * @return Province|null
     */
    public function findById(int $id): ?Province {
        return $this->_repository->find($id);
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return $this->_repository->findAll();
    }
}