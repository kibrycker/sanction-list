<?php

namespace SanctionList\Document;

use SanctionList\Repository\CountryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;
use DateTimeInterface;

#[MongoDB\Document(db: 'sanctions_list', collection: 'country', repositoryClass: CountryRepository::class)]
#[MongoDB\HasLifecycleCallbacks]
class Country
{
    /**
     * @param string|null $id Идентификатор записи
     * @param string|null $name Название страны, союза, организации
     * @param DateTimeInterface|null $dateCreate Дата создания записи
     * @param DateTimeInterface|null $dateUpdate Дата обновления записи
     */
    public function __construct(
        #[MongoDB\Id(name: '_id', type: 'object_id', options: [
            'comment' => 'Идентификатор записи'
        ])]
        public ?string $id = null,

        #[MongoDB\Field(name: 'name', type: Types::STRING, options: [
            'comment' => 'Название страны, союза, организации'
        ])]
        #[Assert\Length(max: 150, maxMessage: 'Максимум 150 символов')]
        private ?string $name = null,

        #[MongoDB\Field(name: 'dateCreate', type: 'date_immutable', options: [
            'comment' => 'Дата создания записи'
        ])]
        private ?DateTimeInterface $dateCreate = null,

        #[MongoDB\Field(name: 'dateUpdate', type: 'date_immutable', options: [
            'comment' => 'Дата обновления записи'
        ])]
        private ?DateTimeInterface $dateUpdate = null
    ) {}

    /**
     * Получение идентификатора
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Получение названия страны, союза, организации
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Установка названия страны, союза, организации
     *
     * @param string $name Название страны, союза, организации
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Получение даты создания
     *
     * @return DateTimeInterface|null
     */
    public function getDateCreate(): ?DateTimeInterface
    {
        return $this->dateCreate;
    }

    /**
     * Установка даты создания
     *
     * @param DateTimeInterface $dateCreate Дата создания записи
     *
     * @return $this
     */
    public function setDateCreate(DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Получение даты обновления
     *
     * @return DateTimeInterface|null
     */
    public function getDateUpdate(): ?DateTimeInterface
    {
        return $this->dateUpdate;
    }

    /**
     * Установка даты обновления
     *
     * @param DateTimeInterface $dateUpdate Дата обновления
     *
     * @return $this
     */
    public function setDateUpdate(DateTimeInterface $dateUpdate): self
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

}