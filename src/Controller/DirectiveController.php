<?php

namespace SanctionList\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use SanctionList\Document\Directive;
use SanctionList\Form\DirectiveType;
use SanctionList\Repository\DirectiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/directive')]
class DirectiveController extends AbstractController
{
    /** @var int Лимит выводимого списка */
    private const DEFAULT_LIMIT_LIST = 10;

    /**
     * @param DocumentManager $dm Менеджер документа
     * @param DirectiveRepository $repository Репозиторий
     */
    public function __construct(
        protected DocumentManager        $dm,
        protected DirectiveRepository $repository
    )
    {
        $this->repository = $this->dm->getRepository(Directive::class);
    }

    /**
     * Список директив
     *
     * @param int $page Номер страницы
     *
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    #[Route(
        '/{page}',
        name: 'sanction_list_directive_index',
        requirements: ['page' => "\d+"],
        methods: ['GET']
    )]
    public function index(int $page = 1): Response
    {
        $offset = self::DEFAULT_LIMIT_LIST * $page - self::DEFAULT_LIMIT_LIST;
        $directives = $this->repository->findBy([], [
            'dateUpdate' => 'DESC'
        ], self::DEFAULT_LIMIT_LIST, $offset);
        $countPages = (int)ceil($this->repository->count() / self::DEFAULT_LIMIT_LIST);
        $pagination = $this->renderView('pagination.html.twig', [
            'page' => $page,
            'countPages' => $countPages,
            'offset' => $offset,
            'urlPath' => 'sanction_list_admin_directive_index',
        ]);
        return $this->render('directive/index.html.twig', [
            'offset' => $offset,
            'directives' => $directives,
            'pagination' => $pagination,
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
    #[Route('/{id}', name: 'sanction_list_directive_show', methods: ['GET'])]
    public function show(Request $request): Response
    {
        $directive = $this->repository->find($request->get('id'));
        return $this->render('directive/show.html.twig', [
            'directive' => $directive,
        ]);
    }
}
