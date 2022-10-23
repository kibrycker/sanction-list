<?php

namespace SanctionList\Repository;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use SanctionList\Document\User;

class UserRepository extends ServiceDocumentRepository
{
    /**
     * Конструктор
     *
     * @param ManagerRegistry $registry менеджер
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

}