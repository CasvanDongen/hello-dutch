<?php
/**
 * Copyright (c) 18-06-2019 20:23, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Service;

use AppBundle\Entity\Category;
use AppBundle\Entity\Province;
use AppBundle\Entity\Recipe;
use AppBundle\Repository\RecipeRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class RecipeService
 * @package AppBundle\Service
 */
class RecipeService {

    /**
     * @var RecipeRepository
     */
    private $recipeRepository;

    /**
     * RecipeService constructor.
     * @param RecipeRepository $recipeRepository
     */
    public function __construct(RecipeRepository $recipeRepository) {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @param int $id
     * @return Recipe
     */
    public function getRecipe(int $id): Recipe {

        $recipe = $this->recipeRepository->findById($id);

        // Throw 404 error when data store returns null
        if ($recipe === null) {
            throw new NotFoundHttpException("Recipe not found");
        }
        return $recipe;
    }

    public function filter(string $term, Category $category, Province $province) {
        return $this->recipeRepository->filterByFields($term, $category, $province);
    }
}