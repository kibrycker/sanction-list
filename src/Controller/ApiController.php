<?php

namespace SanctionList\Controller;

use JsonRpc\Controller;
use SanctionList\Repository\OrganizationRepository;

class ApiController extends Controller
{
    /**
     * @param OrganizationRepository $repository Репозиторий организации
     */
    public function __construct(
        private readonly OrganizationRepository $repository
    )
    {}

    /**
     * Поиск организаций, имеющих санкции
     *
     * @param int|null $requisite Реквизиты организации
     *
     * @return array
     */
    public function search(int $requisite = null): array
    {
        if (empty($requisite)) {
            return [];
        }

        $org = $this->repository->findOneBy(['requisite' => $requisite]);
        return [
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
    }
}