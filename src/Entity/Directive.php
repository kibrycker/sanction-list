<?php

namespace SanctionList\Entity;

use SanctionList\Repository\DirectiveRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property  int|null $id Идентификатор
 * @property string|null $name Название директивы
 * @property string|null $description Описание директивы
 * @property \DateTimeInterface|null $date_create Дата создания записи
 * @property \DateTimeInterface|null $date_update Дата обновления записи
 */
#[ORM\Entity(repositoryClass: DirectiveRepository::class)]
#[ORM\Table(name: 'directives')]
class Directive
{
    /**
     * @param int|null $id Идентификатор
     * @param string|null $name Название директивы
     * @param string|null $description Описание директивы
     * @param \DateTimeInterface|null $date_create Дата создания записи
     * @param \DateTimeInterface|null $date_update Дата обновления записи
     */
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column(type: Types::INTEGER)]
        #[ORM\OneToMany(mappedBy: 'directives', targetEntity: Organization::class)]
        private ?int $id = null,

        #[ORM\Column(type: Types::STRING, length: 255, options: ['comment' => 'Название директивы'])]
        #[Assert\NotBlank(message: 'Заполните название директивы')]
        #[Assert\Length(min: 3, minMessage: 'Минимум 3 символа')]
        private ?string $name = null,

        #[ORM\Column(type: Types::TEXT, options: ['comment' => 'Описание'])]
        #[Assert\Length(min: 3, minMessage: 'Минимум 3 символа')]
        private ?string $description = null,

        #[ORM\Column(type: Types::DATETIME_MUTABLE)]
        private readonly ?\DateTimeInterface $date_create = null,

        #[ORM\Column(type: Types::DATETIME_MUTABLE)]
        private readonly ?\DateTimeInterface $date_update = null
    ) {}

    /**
     * Получение идентификатора
     *
     * @return int|null
     */
    public function getId(): ?int
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
     * @return \DateTimeInterface|null
     */
    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->date_create;
    }

//    /**
//     * Установка даты создания записи
//     *
//     * @param \DateTimeInterface $date_create Дата создания записи
//     *
//     * @return $this
//     */
//    public function setDateCreate(\DateTimeInterface $date_create): self
//    {
//        $this->date_create = $date_create;
//
//        return $this;
//    }

    /**
     * Получение даты обновления
     *
     * @return \DateTimeInterface|null
     */
    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->date_update;
    }

//    /**
//     * Установка даты обновления
//     *
//     * @param \DateTimeInterface $date_update Дата обновления
//     *
//     * @return $this
//     */
//    public function setDateUpdate(\DateTimeInterface $date_update): self
//    {
//        $this->date_update = $date_update;
//
//        return $this;
//    }

    public function __toString()
    {
        return $this->name;
    }
}
