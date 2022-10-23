<?php

namespace SanctionList\DataFixtures;

use Doctrine\Bundle\MongoDBBundle\Fixture\Fixture;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use SanctionList\Document\Country;
use SanctionList\Document\Directive;
use SanctionList\Document\Organization;
use SanctionList\Document\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Создание фейковых данных
 */
class ListFixtures extends Fixture
{
    /** @var int Лимит фейковых записей стран */
    private const LIMIT_RECORD_COUNTRY = 15;
    /** @var int Лимит фейковых записей для директив */
    private const LIMIT_RECORD_DIRECTIVE = 20;
    /** @var int Лимит фейковых записей для организаций */
    private const LIMIT_RECORD_ORGANIZATION = 350;
    /** @var string Используемая локаль для получения фейковых данных */
    private const FAKER_LOCALE = 'ru_RU';

    /**
     * @param DocumentManager $dm Менеджер документов
     */
    public function __construct(
        protected UserPasswordHasherInterface $password,
        protected DocumentManager $dm
    ) {}

    /**
     * Загрузка всех данных
     *
     * @param ObjectManager $manager Менеджер объектов
     *
     * @return void
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->loadUser($manager);
        $this->loadCountry($manager);
        $this->loadDirective($manager);
        $this->loadOrganization($manager);
    }

    /**
     * Генерация и загрузка фейковых пользователей
     *
     * @param ObjectManager $manager Менеджер объектов для сохранения данных
     *
     * @return void
     */
    private function loadUser(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $faker = Factory::create(self::FAKER_LOCALE);
            $user = new User();
            $user->setFullName($faker->firstName());
            $username = $faker->userName();
            $user->setUsername($username);
            $user->setEmail($faker->email());
            $user->setPassword($this->password->hashPassword($user, $username));
            $roles = ['ROLE_ADMIN', 'ROLE_ADMIN', 'ROLE_USER'];
            $user->setRoles([$roles[$i]]);
            $manager->persist($user);
            $this->addReference($username, $user);
            $manager->flush();
        }
    }

    /**
     * Генерация и загрузка фейковых данных по странам
     *
     * @param ObjectManager $manager Менеджер объектов для сохранения данных
     *
     * @return void
     * @throws \Exception
     */
    private function loadCountry(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::LIMIT_RECORD_COUNTRY; $i++) {
            $faker = Factory::create(self::FAKER_LOCALE);
            $country = new Country();
            $country->setName($faker->country());
            $user = $this->getUser();
//            var_dump($user);
            $country->setUser($user);
            $dateCreate = $faker->dateTime();
            $dateUpdate = $faker->dateTimeInInterval($dateCreate, '+ ' . $this->getRandom() . ' days');
            $country->setDateCreate($dateCreate);
            $country->setDateUpdate($dateUpdate);
            $manager->persist($country);
        }
        $manager->flush();
    }

    /**
     * Генерация и загрузка фейковых данных по директивам
     *
     * @param ObjectManager $manager Менеджер объектов для сохранения данных
     *
     * @return void
     * @throws \Exception
     */
    private function loadDirective(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::LIMIT_RECORD_DIRECTIVE; $i++) {
            $faker = Factory::create(self::FAKER_LOCALE);
            $directive = new Directive();
            $directive->setName($faker->word());
            $directive->setDescription($faker->text());
            $dateCreate = $faker->dateTime();
            $dateUpdate = $faker->dateTimeInInterval($dateCreate, '+ ' . $this->getRandom() . ' days');
            $directive->setDateCreate($dateCreate);
            $directive->setDateUpdate($dateUpdate);
            $manager->persist($directive);
        }
        $manager->flush();
    }

    /**
     * Генерация и загрузка фейковых данных по организациям
     *
     * @param ObjectManager $manager Менеджер объектов для сохранения данных
     *
     * @return void
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     */
    private function loadOrganization(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::LIMIT_RECORD_ORGANIZATION; $i++) {
            $faker = Factory::create(self::FAKER_LOCALE);
            $org = new Organization();
            $org->setRequisite($faker->inn10());
            $org->setName($faker->company());
            $org->setStatusOrg($faker->word());
            $org->setKartotekaId($faker->randomDigit());
            $org->setCountry($this->getCountryRandom());
            $dateCreate = rand(0, 1) ? $faker->dateTime() : null;
            $org->setDateInclusion($dateCreate);
            $dateUpdate = null;
            $isUnknownExcDate = rand(0, 1);
            if (rand(0, 1) && !$isUnknownExcDate) {
                null === $dateCreate && $dateCreate = $faker->dateTime();
                $dateUpdate = $faker->dateTimeInInterval($dateCreate, '+ ' . $this->getRandom() . ' days');
            }
            $org->setDateExclusion($dateUpdate);
            $org->setUnknownExcDate((bool)$isUnknownExcDate);
            $org->setBasic(rand(0, 1) ? $faker->text(rand(10, 200)) : null);
            $org->setDirective($this->getDirectiveRandom());
            $dateCreate = $faker->dateTime();
            $org->setDateCreate($dateCreate);
            $dateUpdate = $faker->dateTimeInInterval($dateCreate, '+ ' . $this->getRandom() . ' days');
            $org->setDateUpdate($dateUpdate);
            $manager->persist($org);
        }
        $manager->flush();
    }

    /**
     * Получение случайного администратора
     *
     * @return User|null
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     * @throws \Exception
     */
    private function getUser(): ?User
    {
        $user = $this->dm->getRepository(User::class)->findBy([
            'roles' => 'ROLE_ADMIN'
        ]);
        $index = rand(0, count($user) - 1);
        return $user[$index];
    }

    /**
     * Получение рандомной записи директивы, или возвращааем null
     *
     * @return Country|null
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     * @throws \Exception
     */
    private function getCountryRandom(): ?Country
    {
        $country = $this->dm->createAggregationBuilder(Country::class)
            ->sample(1)->getAggregation()->getIterator()->current();

        return $this->dm->getRepository(Country::class)->find($country['_id']);
    }

    /**
     * Получение рандомной записи директивы, или возвращааем null
     *
     * @return Directive|null
     * @throws \Doctrine\ODM\MongoDB\LockException
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     * @throws \Exception
     */
    private function getDirectiveRandom(): ?Directive
    {
        if (!rand(0, 1)) {
            return null;
        }
        $directive = $this->dm->createAggregationBuilder(Directive::class)
            ->sample(1)->getAggregation()->getIterator()->current();

        return $this->dm->getRepository(Directive::class)->find($directive['_id']);
    }

    /**
     * Получение рандомного числа
     *
     * @return int
     */
    private function getRandom(): int
    {
        return rand(1, 10000);
    }
}
