<?php

namespace SanctionList\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use SanctionList\Document\Directive;
use SanctionList\Form\DirectiveType;
use SanctionList\Repository\DirectiveDocRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sanction-list/admin/directive')]
class DirectiveController extends AbstractController
{
    /**
     * @param DocumentManager $dm Менеджер документа
     * @param DirectiveDocRepository $repository Репозиторий
     */
    public function __construct(
        protected DocumentManager        $dm,
        protected DirectiveDocRepository $repository
    )
    {
        $this->repository = $this->dm->getRepository(Directive::class);
    }


    /**
     * Список директив
     *
     * @return Response
     */
    #[Route('/', name: 'sanction_list_admin_directive_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('directive/index.html.twig', [
            'directives' => $this->repository->findAll(),
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
    #[Route('/new', name: 'sanction_list_admin_directive_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $directive = new Directive();
        $form = $this->createForm(DirectiveType::class, $directive);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repository->add($directive, true);

            return $this->redirectToRoute('sanction_list_admin_directive_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('directive/new.html.twig', [
            'directive' => $directive,
            'form' => $form,
        ]);
    }

    /**
     * Просмотр записи
     *
     * @param string $id Идентификатор документа
     *
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     */
    #[Route('/{id}', name: 'sanction_list_admin_directive_show', methods: ['GET'])]
    public function show(string $id): Response
    {
        $directive = $this->repository->find($id);
        return $this->render('directive/show.html.twig', [
            'directive' => $directive,
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
    #[Route('/{id}/edit', name: 'sanction_list_admin_directive_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request): Response
    {
        $directive = $this->repository->find($request->get('id'));
        $form = $this->createForm(DirectiveType::class, $directive);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repository->add($directive, true);

            return $this->redirectToRoute('sanction_list_admin_directive_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('directive/edit.html.twig', [
            'directive' => $directive,
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
    #[Route('/{id}', name: 'sanction_list_admin_directive_delete', methods: ['POST'])]
    public function delete(Request $request): Response
    {
        $directive = $this->repository->find($request->get('id'));
        if ($this->isCsrfTokenValid('delete' . $directive->getId(), $request->request->get('_token'))) {
            $this->repository->remove($directive, true);
        }

        return $this->redirectToRoute('sanction_list_admin_directive_index', [

        ], Response::HTTP_SEE_OTHER);
    }
}
