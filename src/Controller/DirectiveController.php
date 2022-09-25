<?php

namespace SanctionList\Controller;

use SanctionList\Entity\Directive;
use SanctionList\Form\DirectiveType;
use SanctionList\Repository\DirectiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sanction-list/admin/directive')]
class DirectiveController extends AbstractController
{
    /**
     * Список директив
     *
     * @param DirectiveRepository $directiveRepository Репозиторий стран
     *
     * @return Response
     */
    #[Route('/', name: 'sanction_list_admin_directive_index', methods: ['GET'])]
    public function index(DirectiveRepository $directiveRepository): Response
    {
        return $this->render('directive/index.html.twig', [
            'directives' => $directiveRepository->findAll(),
        ]);
    }

    /**
     * Создание новой записи
     *
     * @param Request $request Запрос
     * @param DirectiveRepository $directiveRepository Репозиторий
     *
     * @return Response
     */
    #[Route('/new', name: 'sanction_list_admin_directive_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DirectiveRepository $directiveRepository): Response
    {
        $directive = new Directive();
        $form = $this->createForm(DirectiveType::class, $directive);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $directiveRepository->add($directive, true);

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
     * @param Directive $directive Сущность
     *
     * @return Response
     */
    #[Route('/{id}', name: 'sanction_list_admin_directive_show', methods: ['GET'])]
    public function show(Directive $directive): Response
    {
        return $this->render('directive/show.html.twig', [
            'directive' => $directive,
        ]);
    }

    /**
     * Редактирование записи
     *
     * @param Request $request Запрос
     * @param Directive $directive Сущность
     * @param DirectiveRepository $directiveRepository Репозиторий
     *
     * @return Response
     */
    #[Route('/{id}/edit', name: 'sanction_list_admin_directive_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request             $request,
        Directive           $directive,
        DirectiveRepository $directiveRepository
    ): Response
    {
        $form = $this->createForm(DirectiveType::class, $directive);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $directiveRepository->add($directive, true);

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
     * @param Directive $directive Сущность
     * @param DirectiveRepository $directiveRepository Репозиторий
     *
     * @return Response
     */
    #[Route('/{id}', name: 'sanction_list_admin_directive_delete', methods: ['POST'])]
    public function delete(
        Request             $request,
        Directive           $directive,
        DirectiveRepository $directiveRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $directive->getId(), $request->request->get('_token'))) {
            $directiveRepository->remove($directive, true);
        }

        return $this->redirectToRoute('sanction_list_admin_directive_index', [], Response::HTTP_SEE_OTHER);
    }
}
