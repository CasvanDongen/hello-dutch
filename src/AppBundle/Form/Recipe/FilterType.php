<?php
/**
 * Copyright (c) 18-06-2019 23:52, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Form\Recipe;


use AppBundle\Entity\Category;
use AppBundle\Entity\Province;
use AppBundle\Entity\Recipe;
use AppBundle\Service\CategoryService;
use AppBundle\Service\ProvinceService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FilterType extends AbstractType {

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var ProvinceService
     */
    private $provinceService;

    /**
     * FilterType constructor.
     * @param CategoryService $categoryService
     * @param ProvinceService $provinceService
     */
    public function __construct(CategoryService $categoryService, ProvinceService $provinceService) {
        $this->categoryService = $categoryService;
        $this->provinceService = $provinceService;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add('term', TextType::class)
            ->add('category', EntityType::class, [
                'class' => 'AppBundle\Entity\Category',
                'choices' => $this->categoryService->getCategories(),
                'choice_label' => function (Category $category) {
                    return $category->getName();
                }
            ])
            ->add('province', EntityType::class, [
                'class' => 'AppBundle\Entity\Province',
                'choices' => $this->provinceService->getProvinces(),
                'choice_label' => function (Province $province) {
                    return $province->getName();
                }
            ])
            ->add('Zoeken', SubmitType::class);
    }
}