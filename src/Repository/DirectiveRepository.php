<?php

namespace SanctionList\Repository;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use SanctionList\Document\Directive;

class DirectiveRepository extends ServiceDocumentRepository
{
    /**
     * Конструктор
     *
     * @param ManagerRegistry $registry менеджер
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Directive::class);
    }

    /**
     * Добавление документа
     *
     * @param Directive $document Документ
     * @param bool $flush Определение сохранять запись или нет
     *
     * @return void
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function add(Directive $document, bool $flush = false): void
    {
        $this->getDocumentManager()->persist($document);
        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }

    /**
     * Удаление документа
     *
     * @param Directive $document Документ
     * @param bool $flush Определение сохранять запись или нет
     *
     * @return void
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function remove(Directive $document, bool $flush = false): void
    {
        $this->getDocumentManager()->remove($document);
        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }

    /**
     * Получение количества записей
     *
     * @return int
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function count(): int
    {
        return $this->dm->createQueryBuilder(Directive::class)
            ->count()->getQuery()->execute();
    }
}