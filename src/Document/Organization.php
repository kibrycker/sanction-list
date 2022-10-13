<?php

namespace SanctionList\Document;

use Doctrine\DBAL\Types\Types;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use SanctionList\Repository\OrganizationDocRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

/**
 * Документ с организациями, в отношении которых применены санкции
 *
 * @property  int|null $id Идентификатор
 * @property string|null $requisite Реквизиты
 * @property string|null $name Наименование
 * @property string|null $statusOrg Статус организации
 * @property int|null $kartotekaId Идентификатор организации kartoteka_v3_1.organizations
 * @property Country|null $country Страна, применившая санкции из sanctions_list.country_sanction.id
 * @property DateTimeInterface|null $dateInclusion Дата включения
 * @property DateTimeInterface|null $dateExclusion Дата исключения
 * @property bool $unknownExcDate До распоряжения об отмене санкций
 * @property Directive|null $directive Директивы из sanctions_list.directive.id
 * @property DateTimeInterface|null $dateCreate Дата создания записи
 * @property DateTimeInterface|null $dateUpdate Дата обновления записи
 */
#[MongoDB\Document(
    db: 'sanctions_list',
    collection: 'organization',
    repositoryClass: OrganizationDocRepository::class
)]
#[MongoDB\HasLifecycleCallbacks]
class Organization
{

    /**
     * @param int|null $id Идентификатор
     * @param string|null $requisite Реквизиты
     * @param string|null $name Наименование
     * @param string|null $statusOrg Статус организации
     * @param int|null $kartotekaId Идентификатор организации kartoteka_v3_1.organizations
     * @param Country|null $country Страна, применившая санкции из sanctions_list.country_sanction.id
     * @param DateTimeInterface|null $dateInclusion Дата включения
     * @param DateTimeInterface|null $dateExclusion Дата исключения
     * @param bool $unknownExcDate До распоряжения об отмене санкций
     * @param Directive|null $directive Директивы из sanctions_list.directive.id
     * @param DateTimeInterface|null $dateCreate Дата создания записи
     * @param DateTimeInterface|null $dateUpdate Дата обновления записи
     */
    public function __construct(
        #[MongoDB\Id(name: '_id', type: 'object_id', options: [
            'comment' => 'Идентификатор записи',
        ])]
        protected ?int                $id = null,

        #[MongoDB\Field(type: Types::STRING, nullable: true, options: [
            'fixed' => true,
            'comment' => 'Реквизиты',
        ])]
        #[Assert\NotBlank]
        protected ?string             $requisite = null,

        #[MongoDB\Field(type: Types::STRING, nullable: true, options: [
            'comment' => 'Наименование',
        ])]
        #[Assert\NotBlank]
        protected ?string             $name = null,

        #[MongoDB\Field(type: Types::STRING, nullable: true, options: [
            'comment' => 'Статус организации',
        ])]
        protected ?string             $statusOrg = null,

        #[MongoDB\Field(type: Types::INTEGER, options: [
            'comment' => 'kartoteka_v3_1.organizations - id карточки',
        ])]
        protected ?int                $kartotekaId = null,

        #[MongoDB\ReferenceOne(options: [
            'comment' => 'Страна'
        ], targetDocument: Country::class)]
        #[Assert\NotBlank]
        protected ?Country            $country = null,

        #[MongoDB\Field(type: 'date_immutable', nullable: true, options: [
            'comment' => 'Дата включения',
        ])]
        protected ?\DateTimeInterface $dateInclusion = null,

        #[MongoDB\Field(type: 'date_immutable', nullable: true, options: [
            'comment' => 'Дата исключения',
        ])]
        protected ?\DateTimeInterface $dateExclusion = null,

        #[MongoDB\Field(type: Types::BOOLEAN, nullable: false, options: [
            'comment' => 'До распоряжения об отмене санкций',
        ])]
        protected bool                $unknownExcDate = false,

        #[MongoDB\ReferenceOne(targetDocument: Directive::class, inversedBy: 'id')]
        protected ?Directive          $directive = null,

        #[MongoDB\Field(type: 'date_immutable', options: [
            'comment' => 'Дата создания записи',
        ])]
        protected ?\DateTimeInterface $dateCreate = null,

        #[MongoDB\Field(type: 'date_immutable', options: [
            'comment' => 'Дата обновления записи',
        ])]
        protected ?\DateTimeInterface $dateUpdate = null
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
     * Получение названия организации
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Установка названия организации
     *
     * @param string|null $name Название организации
     *
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Получение реквизита организации
     *
     * @return string|null
     */
    public function getRequisite(): ?string
    {
        return $this->requisite;
    }

    /**
     * Установка реквизита организации
     *
     * @param string|null $requisite Реквизит организации ИНН/ОГРН
     *
     * @return $this
     */
    public function setRequisite(?string $requisite): self
    {
        $this->requisite = $requisite;

        return $this;
    }

    /**
     * Получение статуса организации
     *
     * @return string|null
     */
    public function getStatusOrg(): ?string
    {
        return $this->statusOrg;
    }

    /**
     * Установка статуса организации
     *
     * @param string|null $statusOrg Статус организации
     *
     * @return $this
     */
    public function setStatusOrg(?string $statusOrg): self
    {
        $this->statusOrg = $statusOrg;

        return $this;
    }

    /**
     * Получение идентификатора страны
     *
     * @return Country|null
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    /**
     * Установка идентификатора страны
     *
     * @param Country|null $country Идентификатор страны
     *
     * @return $this
     */
    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Получение даты включения
     *
     * @return \DateTimeInterface|null
     */
    public function getDateInclusion(): ?\DateTimeInterface
    {
        return $this->dateInclusion;
    }

    /**
     * Установка даты включения
     *
     * @param \DateTimeInterface|null $dateInclusion Дата включения
     *
     * @return $this
     */
    public function setDateInclusion(?\DateTimeInterface $dateInclusion): self
    {
        $this->dateInclusion = $dateInclusion;

        return $this;
    }

    /**
     * Получение даты исключения
     *
     * @return \DateTimeInterface|null
     */
    public function getDateExclusion(): ?\DateTimeInterface
    {
        return $this->dateExclusion;
    }

    /**
     * Установка даты исключения
     *
     * @param \DateTimeInterface|null $dateExclusion Дата исключения
     *
     * @return $this
     */
    public function setDateExclusion(?\DateTimeInterface $dateExclusion): self
    {
        $this->dateExclusion = $dateExclusion;

        return $this;
    }

    /**
     * Получение отметки распоряжения об отмене санкции
     *
     * @return bool
     */
    public function getUnknownExcDate(): bool
    {
        return $this->unknownExcDate;
    }

    /**
     * Установка отметки распоряжения об отмене санкции
     *
     * @param bool $unknownExcDate Отметка распоряжения об отмене санкции
     *
     * @return $this
     */
    public function setUnknownExcDate(bool $unknownExcDate): self
    {
        $this->unknownExcDate = $unknownExcDate;

        return $this;
    }

    /**
     * Получение идентификатора карточки компаниии
     *
     * @return int|null
     */
    public function getKartotekaId(): ?int
    {
        return $this->kartotekaId;
    }

    /**
     * Установка идентификатора карточки компаниии
     *
     * @param int|null $kartotekaId Идентификатор карточки компаниии
     *
     * @return $this
     */
    public function setKartotekaId(?int $kartotekaId): self
    {
        $this->kartotekaId = $kartotekaId;

        return $this;
    }

    /**
     * Получение идентификатора директивы
     *
     * @return Directive|null
     */
    public function getDirective(): ?Directive
    {
        return $this->directive;
    }

    /**
     * Установка идентификатора директивы
     *
     * @param Directive|null $directive Идентификатор директивы
     *
     * @return $this
     */
    public function setDirective(?Directive $directive): self
    {
        $this->directive = $directive;

        return $this;
    }

    /**
     * Получение даты создания записи
     *
     * @return \DateTimeInterface|null
     */
    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    /**
     * Установка даты создания записи
     *
     * @param \DateTimeInterface $dateCreate Дата создания записи
     *
     * @return $this
     */
    public function setDateCreate(\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Получение даты обновления записи
     *
     * @return \DateTimeInterface|null
     */
    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->dateUpdate;
    }

    /**
     * Установка даты обновления записи
     *
     * @param \DateTimeInterface $dateUpdate Дата обновления записи
     *
     * @return $this
     */
    public function setDateUpdate(\DateTimeInterface $dateUpdate): self
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

}