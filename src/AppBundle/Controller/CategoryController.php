<?php
/**
 * Copyright (c) 18-06-2019 21:8, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Controller;


use AppBundle\Service\CategoryService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryController
 * @package AppBundle\Controller
 */
class CategoryController extends BaseController {

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    /**
     * @return Response
     */
    public function overviewAction(): Response {

        $categories = $this->categoryService->getCategories();

        // Render view
        return $this->render('category/overview.html.twig', [
            'categories' => $categories
        ]);
    }
}