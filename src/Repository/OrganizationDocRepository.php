<?php

namespace SanctionList\Repository;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use SanctionList\Document\Organization;

class OrganizationDocRepository extends ServiceDocumentRepository
{
    /**
     * Конструктор
     *
     * @param ManagerRegistry $registry менеджер
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Organization::class);
    }

    /**
     * Добавление документа
     *
     * @param Organization $document Документ
     * @param bool $flush Определение сохранять запись или нет
     *
     * @return void
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function add(Organization $document, bool $flush = false): void
    {
        $this->getDocumentManager()->persist($document);
        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }

    /**
     * Удаление документа
     *
     * @param Organization $document Документ
     * @param bool $flush Определение сохранять запись или нет
     *
     * @return void
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function remove(Organization $document, bool $flush = false): void
    {
        $this->getDocumentManager()->remove($document);
        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }

}