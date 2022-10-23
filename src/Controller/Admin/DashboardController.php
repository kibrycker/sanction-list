<?php

namespace SanctionList\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/dashboard')]
class DashboardController extends AbstractController
{

    #[Route('/', name: 'sanction_list_admin_dashboard_index')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', []);
    }
}