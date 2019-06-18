<?php
/**
 * Copyright (c) 18-06-2019 19:39, Cas van Dongen <cas.vandongen@gmail.com>
 * Gemaakt in opdracht van Pronexus & Team Rockstars IT
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\User\RegistrationType;
use AppBundle\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class UserController
 * @package AppBundle\Controller
 */
class UserController extends BaseController {

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * UserController constructor.
     * @param UserService $userService
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(UserService $userService, AuthenticationUtils $authenticationUtils) {
        $this->userService = $userService;
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request): Response {

        // Create form for user registration
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        // Handle form submissions
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Create user and redirect to /login
            $this->userService->createUser($user);
            $this->addFlash('success', 'Account was created');
            $this->redirectToRoute('user_login');
        }

        // Render view
        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @return Response
     */
    public function loginAction(): Response {

        $previousUsername = $this->authenticationUtils->getLastUsername();
        $error = $this->authenticationUtils->getLastAuthenticationError();

        // Return view
        return $this->render('user/login.html.twig', [
            'previousUsername' => $previousUsername,
            'error' => $error
        ]);
    }
}