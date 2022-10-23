<?php

namespace SanctionList\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{

    #[Route('/login', name: 'security_login')]
    public function login(Request $request): Response
    {
        return $this->render('security/login.html.twig', []);
    }

    #[Route('/logout', name: 'security_logout')]
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }
}