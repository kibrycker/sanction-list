<?php

namespace SanctionList\Controller;

use JsonRpc\Controller;
use SanctionList\Entity\Organization;
use SanctionList\Repository\OrganizationRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\ServiceProviderInterface;

//#[Route('/sanction-list/api')]
class ApiController extends Controller
{
//    /** @var array Параметры запроса (значение params) */
//    protected array $requestParams;
//
//    /** @var string Вызываемый метод (значение method) */
//    public string $requestMethod;
//
//    /** @var int Идентификатор запроса (значение id) */
//    protected int $requestId;

//    /**
//     * @param array $requestParams Параметры запроса (значение params)
//     * @param int $requestId Идентификатор запроса (значение id)
//     */
    public function __construct(
//        public ServiceProviderInterface $provider
    )
    {
//        $this->container->get('requestParams');
//        $this->requestParams = $requestParams;
//        $this->requestMethod = $requestMethod;
//        $this->requestId = $requestId;
    }

//    #[Route('/show', name: 'sanction_list_api_show', methods: ['GET', 'POST'])]
    public function show(OrganizationRepository $repository): JsonResponse
    {
        $org = $repository->findOneBy(['requisite' => 45235345]);
        $result = [
            'name' => $org->getName(),
            'requisite' => $org->getRequisite(),
            'status' => $org->getStatusOrg(),
            'kartotekaId' => $org->getKartotekaId(),
            'date' => [
                'inclusion' => $org->getDateInclusion()?->format('Y-m-d'),
                'exclusion' => $org->getDateExclusion()?->format('Y-m-d'),
                'unknown' => $org->getUnknownExdate(),
            ],
            'country' => $org->getCountry()->getName(),
            'directive' => $org->getDirective()->getName(),
        ];

//        return $result;
        return new JsonResponse($result);
    }
}