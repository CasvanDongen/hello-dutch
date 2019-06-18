<?php
/**
 * Copyright (c) 18-06-2019 19:20, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends BaseController {

    /**
     * @return Response
     */
    public function homeAction(): Response {

        // Render view
        return $this->render('default/index.html.twig');
    }

    /**
     * @return Response
     */
    public function dashboardAction(): Response {

        // Render view
        return $this->render('default/dashboard.html.twig', [
            'user' => $this->getUser()->getUsername()
        ]);
    }
}
