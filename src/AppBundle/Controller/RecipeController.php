<?php
/**
 * Copyright (c) 18-06-2019 20:19, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Controller;

use AppBundle\Form\Recipe\FilterType;
use AppBundle\Service\RecipeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class RecipeController
 * @package AppBundle\Controller
 */
class RecipeController extends BaseController {

    /**
     * @var RecipeService
     */
    private $recipeService;

    /**
     * RecipeController constructor.
     * @param RecipeService $recipeService
     */
    public function __construct(RecipeService $recipeService) {
        $this->recipeService = $recipeService;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function singleAction(int $id): Response {

        $recipe = $this->recipeService->getRecipe($id);

        // Render view
        return $this->render('recipe/single.html.twig', [
            'recipe' => $recipe
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function filterAction(Request $request): Response {

        // Create form and set results initial state
        $results = null;
        $form = $this->createForm(FilterType::class);

        // Handle form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Get data and fill results
            $data = $form->getData();
            $results = $this->recipeService->filter($data['term'], $data['category'], $data['province']);
        }

        return $this->render('recipe/filter.html.twig', [
            'form' => $form->createView(),
            'results' => $results
        ]);

//        // Get term parameter from request
//        $term = $request->query->get('term');
//        if ($term === null) {
//            throw new BadRequestHttpException("Wrong parameter given");
//        }
//
//        // Search recipe, @todo text search should not use simple LIKE query.
//        $recipes = $this->recipeService->generalSearch($term);
//
//        // Render view
//        return $this->render('recipe/filter.html.twig', [
//            'term' => $term,
//            'results' => $recipes
//        ]);
    }
}