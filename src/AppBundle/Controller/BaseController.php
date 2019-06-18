<?php
/**
 * Copyright (c) 18-06-2019 19:58, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class BaseController extends Controller {

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * Use @required for auto loading tokenStorage into baseController
     *
     * @param TokenStorageInterface $tokenStorage
     * @required
     */
    public function setTokenStorage(TokenStorageInterface $tokenStorage) {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Overwrites default method to get user with better type checking.
     *
     * @return User|null
     */
    protected function getUser(): ?User {

        // Get token and check if it's null or not an object at all return null.ø
        $token = $this->tokenStorage->getToken();
        if ($token === null) {
            return null;
        }

        $user = $token->getUser();
        if (!($user instanceof User)) {
            return null;
        }

        // Return user object
        return $user;
    }

}