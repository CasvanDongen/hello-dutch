<?php
/**
 * Copyright (c) 18-06-2019 21:11, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Service;

use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CategoryService
 * @package AppBundle\Service
 */
class CategoryService {

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function getCategory(int $id): Category {

        $category = $this->categoryRepository->findById($id);

        // Throw 404 error when data store returns null
        if ($category === null) {
            throw new NotFoundHttpException("Category not found");
        }
        return $category;
    }

    /**
     * @return Category[]
     */
    public function getCategories(): array {
        return $this->categoryRepository->findAll();
    }
}