<?php

namespace SanctionList\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * Страница авторизации
     *
     * @param Request $request Запрос
     * @param AuthenticationUtils $helper
     *
     * @return Response
     */
    #[Route('/login', name: 'sanction_list_security_login')]
    public function login(Request $request, AuthenticationUtils $helper): Response
    {
        if ($user = $this->getUser()) {
            /** Проверяем на админа, для определения куда кого кидать */
            $isAdmin = in_array('ROLE_ADMIN', $user->getRoles());
            $routes = 'sanction_list_' . ($isAdmin ? 'admin_' : '') . 'organization_index';
            return $this->redirectToRoute($routes);
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $helper->getLastUsername(),
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }

    /**
     * Страница деавторизации
     *
     * @return void
     * @throws \Exception
     */
    #[Route('/logout', name: 'sanction_list_security_logout')]
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }
}