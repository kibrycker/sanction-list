<?php

namespace SanctionList\Controller;

use JsonRpc\Controller;
use SanctionList\DTO\SearchParamsDTO;
use SanctionList\Repository\OrganizationDocRepository;

class ApiController extends Controller
{
    /**
     * @param OrganizationDocRepository $repository Репозиторий организации
     */
    public function __construct(
        private readonly OrganizationDocRepository $repository
    ) {}

    /**
     * Поиск организаций, имеющих санкции
     *
     * @param SearchParamsDTO $params Реквизиты организации
     *
     * @return array
     */
    public function search(SearchParamsDTO $params): array
    {
        $requestParams = [];
        if ($params->requisite) {
            $requestParams['requisite'] = $params->requisite;
        }
        if ($params->kartotekaId) {
            $requestParams['kartotekaId'] = $params->kartotekaId;
        }
        if (empty($requestParams)) {
            return [];
        }

        $offset = $params->size * ($params->from - 1);
        $data = $this->repository->findBy($requestParams, $params->orderBy, $params->size, $offset);
        return [
            'data' => array_map(function ($datum) {
                return [
                    'name' => $datum->getName(),
                    'requisite' => $datum->getRequisite(),
                    'status' => $datum->getStatusOrg(),
                    'kartotekaId' => $datum->getKartotekaId(),
                    'date' => [
                        'inclusion' => $datum->getDateInclusion()?->format('Y-m-d'),
                        'exclusion' => $datum->getDateExclusion()?->format('Y-m-d'),
                        'unknown' => $datum->getUnknownExcDate(),
                    ],
                    'country' => $datum->getCountry()?->getName(),
                    'directive' => $datum->getDirective()?->getName(),
                ];
            }, $data),
        ];
        $result = [];
        foreach ($data as $datum) {
            $result['data'][] = [
                'name' => $datum->getName(),
                'requisite' => $datum->getRequisite(),
                'status' => $datum->getStatusOrg(),
                'kartotekaId' => $datum->getKartotekaId(),
                'date' => [
                    'inclusion' => $datum->getDateInclusion()?->format('Y-m-d'),
                    'exclusion' => $datum->getDateExclusion()?->format('Y-m-d'),
                    'unknown' => $datum->getUnknownExcDate(),
                ],
                'country' => $datum->getCountry()?->getName(),
                'directive' => $datum->getDirective()?->getName(),
            ];
        }

        return $result;
    }
}