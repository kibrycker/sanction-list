<?php

namespace SanctionList\Controller;

use SanctionList\Entity\Organization;
use SanctionList\Form\OrganizationType;
use SanctionList\Repository\OrganizationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sanction-list/admin/organization')]
class OrganizationController extends AbstractController
{
    /**
     * Список организаций
     *
     * @param OrganizationRepository $repository Репозиторий
     *
     * @return Response
     */
    #[Route('/', name: 'sanction_list_admin_organization_index', methods: ['GET'])]
    public function index(OrganizationRepository $repository): Response
    {
        return $this->render('organization/index.html.twig', [
            'organizations' => $repository->findAll(),
        ]);
    }

    /**
     * Создание новой записи
     *
     * @param Request $request Запрос
     * @param OrganizationRepository $repository Репозиторий
     *
     * @return Response
     */
    #[Route('/new', name: 'sanction_list_admin_organization_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OrganizationRepository $repository): Response
    {
        $organization = new Organization();
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->add($organization, true);

            return $this->redirectToRoute('sanction_list_organization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('organization/new.html.twig', [
            'organization' => $organization,
            'form' => $form,
        ]);
    }

    /**
     * Просмотр записи
     *
     * @param Organization $organization Сущность
     *
     * @return Response
     */
    #[Route('/{id}', name: 'sanction_list_admin_organization_show', methods: ['GET'])]
    public function show(Organization $organization): Response
    {
        return $this->render('organization/show.html.twig', [
            'organization' => $organization,
        ]);
    }

    /**
     * Редактирование записи
     *
     * @param Request $request Запрос
     * @param Organization $organization Сущность
     * @param OrganizationRepository $repository Репозиторий
     *
     * @return Response
     */
    #[Route('/{id}/edit', name: 'sanction_list_admin_organization_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request                $request,
        Organization           $organization,
        OrganizationRepository $repository
    ): Response
    {
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->add($organization, true);

            return $this->redirectToRoute('sanction_list_admin_organization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('organization/edit.html.twig', [
            'organization' => $organization,
            'form' => $form,
        ]);
    }

    /**
     * Удаление записи
     *
     * @param Request $request Запрос
     * @param Organization $organization Сущность
     * @param OrganizationRepository $repository Репозиторий
     *
     * @return Response
     */
    #[Route('/{id}', name: 'sanction_list_admin_organization_delete', methods: ['POST'])]
    public function delete(
        Request                $request,
        Organization           $organization,
        OrganizationRepository $repository
    ): Response
    {
        if ($this->isCsrfTokenValid('delete' . $organization->getId(), $request->request->get('_token'))) {
            $repository->remove($organization, true);
        }

        return $this->redirectToRoute('sanction_list_admin_organization_index', [], Response::HTTP_SEE_OTHER);
    }
}
