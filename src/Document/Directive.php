<?php

namespace SanctionList\Document;

use Doctrine\ODM\MongoDB\Types\Type;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use SanctionList\Repository\DirectiveRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;


#[MongoDB\Document(db: 'sanctions_list', collection: 'directive', repositoryClass: DirectiveRepository::class)]
#[MongoDB\HasLifecycleCallbacks]
class Directive
{
    public function __construct(
        #[MongoDB\Id(name: '_id', type: Type::OBJECTID, options: [
            'comment' => 'Идентификатор записи',
        ])]
//        #[MongoDB\ReferenceMany(mappedBy: 'directive', collectionClass: Organization::class)]
        protected ?string $id = null,

        #[MongoDB\Field(type: Type::STRING, options: ['comment' => 'Название директивы'])]
        #[Assert\NotBlank(message: 'Заполните название директивы')]
        #[Assert\Length(min: 3, minMessage: 'Минимум 3 символа')]
        protected ?string            $name = null,

        #[MongoDB\Field(type: Type::STRING, options: ['comment' => 'Описание'])]
        #[Assert\Length(min: 3, minMessage: 'Минимум 3 символа')]
        protected ?string            $description = null,

        #[MongoDB\Field(name: 'dateCreate', type: Type::DATE_IMMUTABLE, options: [
            'comment' => 'Дата создания записи',
        ])]
        #[MongoDB\Index()]
        protected ?DateTimeInterface $dateCreate = null,

        #[MongoDB\Field(name: 'dateUpdate', type: Type::DATE_IMMUTABLE, options: [
            'comment' => 'Дата обновления записи',
        ])]
        #[MongoDB\Index()]
        protected ?DateTimeInterface $dateUpdate = null
    ) {}

    /**
     * Получение идентификатора
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Получение названия
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Установка названия
     *
     * @param string $name Название
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Получение описания
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Установка описания
     *
     * @param string $description Описание
     *
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Получение даты создания записи
     *
     * @return DateTimeInterface|null
     */
    public function getDateCreate(): ?DateTimeInterface
    {
        return $this->dateCreate;
    }

    /**
     * Установка даты создания записи
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
     * Преобразование в строку значения
     * @return string|null
     */
    public function __toString()
    {
        return $this->name;
    }

}