<?php

namespace SanctionList\Repository;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use SanctionList\Document\Country;

/**
 * @extends ServiceDocumentRepository<Country>
 *
 * @method Country|null find($id, $lockMode = null, $lockVersion = null)
 * @method Country|null findOneBy(array $criteria, array $orderBy = null)
 * @method Country[]    findAll()
 * @method Country[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryRepository extends ServiceDocumentRepository
{
    /**
     * Конструктор
     *
     * @param ManagerRegistry $registry менеджер
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    /**
     * Добавление документа
     *
     * @param Country $document Документ
     * @param bool $flush Определение сохранять запись или нет
     *
     * @return void
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function add(Country $document, bool $flush = false): void
    {
        $this->getDocumentManager()->persist($document);
        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }

    /**
     * Удаление документа
     *
     * @param Country $document Документ
     * @param bool $flush Определение сохранять запись или нет
     *
     * @return void
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function remove(Country $document, bool $flush = false): void
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
        return $this->dm->createQueryBuilder(Country::class)
            ->count()->getQuery()->execute();
    }
}