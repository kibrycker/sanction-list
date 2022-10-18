<?php

namespace SanctionList\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use SanctionList\Document\Organization;
use SanctionList\Form\OrganizationType;
use SanctionList\Repository\OrganizationDocRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sanction-list/admin/organization')]
class OrganizationController extends AbstractController
{
    /** @var int Лимит выводимого списка */
    private const DEFAULT_LIMIT_LIST = 10;

    /**
     * Конструктовр
     *
     * @param DocumentManager $dm Менеджер документа
     * @param OrganizationDocRepository $repository Репозиторий
     */
    public function __construct(
        protected DocumentManager           $dm,
        protected OrganizationDocRepository $repository
    )
    {
        $this->repository = $this->dm->getRepository(Organization::class);
    }

    /**
     * Список организаций
     *
     * @param int $page Номер страницы
     *
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    #[Route(
        '/{page}',
        name: 'sanction_list_admin_organization_index',
        requirements: ['page' => "\d+"],
        methods: ['GET']
    )]
    public function index(int $page = 1): Response
    {
        $offset = self::DEFAULT_LIMIT_LIST * $page - self::DEFAULT_LIMIT_LIST;
        $organizations = $this->repository->findBy([], [
            'dateUpdate' => 'DESC'
        ], self::DEFAULT_LIMIT_LIST, $offset);
        $countPages = (int)ceil($this->repository->count() / self::DEFAULT_LIMIT_LIST);
        $pagination = $this->renderView('pagination.html.twig', [
            'page' => $page,
            'countPages' => $countPages,
            'offset' => $offset,
            'urlPath' => 'sanction_list_admin_organization_index',
        ]);
        return $this->render('organization/index.html.twig', [
            'offset' => $offset,
            'organizations' => $organizations,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Создание новой записи
     *
     * @param Request $request Запрос
     *
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    #[Route('/new', name: 'sanction_list_admin_organization_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $organization = new Organization();
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repository->add($organization, true);

            return $this->redirectToRoute('sanction_list_admin_organization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('organization/new.html.twig', [
            'organization' => $organization,
            'form' => $form,
        ]);
    }

    /**
     * Просмотр записи
     *
     * @param Request $request Запрос
     *
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     */
    #[Route('/{id}', name: 'sanction_list_admin_organization_show', methods: ['GET'])]
    public function show(Request $request): Response
    {
        $organization = $this->repository->find($request->get('id'));
        return $this->render('organization/show.html.twig', [
            'organization' => $organization,
        ]);
    }

    /**
     * Редактирование записи
     *
     * @param Request $request Запрос
     *
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    #[Route('/{id}/edit', name: 'sanction_list_admin_organization_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request): Response
    {
        $organization = $this->repository->find($request->get('id'));
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repository->add($organization, true);

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
     *
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    #[Route('/{id}', name: 'sanction_list_admin_organization_delete', methods: ['POST'])]
    public function delete(Request      $request): Response
    {
        $organization = $this->repository->find($request->get('id'));
        if ($this->isCsrfTokenValid('delete' . $organization->getId(), $request->request->get('_token'))) {
            $this->repository->remove($organization, true);
        }

        return $this->redirectToRoute('sanction_list_admin_organization_index', [], Response::HTTP_SEE_OTHER);
    }
}
