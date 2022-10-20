<?php

namespace SanctionList\DTO;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * DTO параметров получения данных по оргназациям
 */
class SearchParamsDTO extends DataTransferObject
{
    /** @var int|null $requisite Реквизиты */
    public ?int $requisite = null;

    /** @var int|null $kartotekaId Идентификатор организации kartoteka_v3_1.organizations */
    public ?int $kartotekaId = null;

    /** @var array|null Сортировка вывода. По какому полю сортировать */
    public ?array $orderBy = ['dateUpdate' => 'DESC'];

    /** @var int|null Лимит (размер) выборки */
    public ?int $size = 10;

    /** @var int|null С какой страницы выводить */
    public ?int $from = 1;
}