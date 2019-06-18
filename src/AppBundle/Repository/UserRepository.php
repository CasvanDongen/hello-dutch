<?php
/**
 * Copyright (c) 18-06-2019 19:48, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserRepository
 * @package AppBundle\Repository
 */
class UserRepository {

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
        $this->_repository = $this->_em->getRepository(User::class);
    }

    /**
     * Save user to data storage
     *
     * @param User $user
     * @return User
     */
    public function create(User $user): User {

        $this->_em->persist($user);
        $this->_em->flush();
        return $user;
    }

}