<?php
/**
 * Copyright (c) 18-06-2019 21:11, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Service;

use AppBundle\Entity\Province;
use AppBundle\Repository\ProvinceRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ProvinceService
 * @package AppBundle\Service
 */
class ProvinceService {

    /**
     * @var ProvinceRepository
     */
    private $provinceRepository;

    /**
     * ProvinceService constructor.
     * @param ProvinceRepository $provinceRepository
     */
    public function __construct(ProvinceRepository $provinceRepository) {
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * @param int $id
     * @return Province
     */
    public function getProvince(int $id): Province {

        $province = $this->provinceRepository->findById($id);

        // Throw 404 error when data store returns null
        if ($province === null) {
            throw new NotFoundHttpException("Province not found");
        }
        return $province;
    }

    /**
     * @return Province[]
     */
    public function getProvinces(): array {
        return $this->provinceRepository->findAll();
    }
}