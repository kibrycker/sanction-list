<?php

namespace SanctionList\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use SanctionList\Document\Country;
use SanctionList\Form\CountryType;
use SanctionList\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sanction-list/admin/country')]
class CountryController extends AbstractController
{
    /**
     * @param DocumentManager $dm Менеджер документа
     * @param CountryRepository $repository Репозиторий
     */
    public function __construct(
        protected DocumentManager $dm,
        protected CountryRepository $repository
    ) {
        $this->repository = $this->dm->getRepository(Country::class);
    }

    /**
     * Список стран
     *
     * @return Response
     */
    #[Route('/', name: 'sanction_list_admin_country_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('country/index.html.twig', [
            'countries' => $this->repository->findAll(),
        ]);
    }

    /**
     * Создание новой записи
     *
     * @param Request $request Запрос
     * @param CountryRepository $repository Репозиторий
     *
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    #[Route('/new', name: 'sanction_list_admin_country_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CountryRepository $repository): Response
    {
        $country = new Country();
        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->add($country, true);

            return $this->redirectToRoute('sanction_list_admin_country_index', [

            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('country/new.html.twig', [
            'country' => $country,
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
    #[Route('/{id}', name: 'sanction_list_admin_country_show', methods: ['GET'])]
    public function show(string $id): Response
    {
        $country = $this->repository->find($id);
        return $this->render('country/show.html.twig', [
            'country' => $country,
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
    #[Route('/{id}/edit', name: 'sanction_list_admin_country_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request): Response
    {
        $country = $this->repository->find($request->get('id'));
        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repository->add($country, true);

            return $this->redirectToRoute('sanction_list_admin_country_index', [

            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('country/edit.html.twig', [
            'country' => $country,
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
    #[Route('/{id}', name: 'sanction_list_admin_country_delete', methods: ['POST'])]
    public function delete(Request $request): Response
    {
        $country = $this->repository->find($request->get('id'));
        if ($this->isCsrfTokenValid('delete' . $country->getId(),
            $request->request->get('_token'))) {
            $this->repository->remove($country, true);
        }

        return $this->redirectToRoute('sanction_list_admin_country_index', [

        ], Response::HTTP_SEE_OTHER);
    }
}
