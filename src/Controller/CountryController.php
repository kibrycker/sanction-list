<?php

namespace SanctionList\Controller;

use SanctionList\Entity\Country;
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
     * Список стран
     *
     * @param CountryRepository $countryRepository Репозиторий
     *
     * @return Response
     */
    #[Route('/', name: 'sanction_list_admin_country_index', methods: ['GET'])]
    public function index(CountryRepository $countryRepository): Response
    {
        return $this->render('country/index.html.twig', [
            'countries' => $countryRepository->findAll(),
        ]);
    }

    /**
     * Создание новой записи
     *
     * @param Request $request Запрос
     * @param CountryRepository $countryRepository Репозиторий
     *
     * @return Response
     */
    #[Route('/new', name: 'sanction_list_admin_country_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CountryRepository $countryRepository): Response
    {
        $country = new Country();
        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $countryRepository->add($country, true);

            return $this->redirectToRoute('sanction_list_admin_country_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('country/new.html.twig', [
            'country' => $country,
            'form' => $form,
        ]);
    }

    /**
     * Просмотр записи
     *
     * @param Country $country Сущность
     *
     * @return Response
     */
    #[Route('/{id}', name: 'sanction_list_admin_country_show', methods: ['GET'])]
    public function show(Country $country): Response
    {
        return $this->render('country/show.html.twig', [
            'country' => $country,
        ]);
    }

    /**
     * Редактирование записи
     *
     * @param Request $request Запрос
     * @param Country $country Сущность
     * @param CountryRepository $countryRepository Репозиторий
     *
     * @return Response
     */
    #[Route('/{id}/edit', name: 'sanction_list_admin_country_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Country $country, CountryRepository $countryRepository): Response
    {
        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $countryRepository->add($country, true);

            return $this->redirectToRoute('sanction_list_admin_country_index', [], Response::HTTP_SEE_OTHER);
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
     * @param Country $country Сущность
     * @param CountryRepository $countryRepository Репозиторий
     *
     * @return Response
     */
    #[Route('/{id}', name: 'sanction_list_admin_country_delete', methods: ['POST'])]
    public function delete(Request $request, Country $country, CountryRepository $countryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $country->getId(), $request->request->get('_token'))) {
            $countryRepository->remove($country, true);
        }

        return $this->redirectToRoute('sanction_list_admin_country_index', [], Response::HTTP_SEE_OTHER);
    }
}
