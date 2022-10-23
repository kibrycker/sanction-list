<?php

namespace SanctionList\Document;

use Doctrine\ODM\MongoDB\Types\Type;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use SanctionList\Repository\OrganizationRepository;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

/**
 * Документ с организациями, в отношении которых применены санкции
 *
 * @property string|null $id Идентификатор
 * @property string|null $requisite Реквизиты
 * @property string|null $name Наименование
 * @property string|null $statusOrg Статус организации
 * @property int|null $kartotekaId Идентификатор организации kartoteka_v3_1.organizations
 * @property Country|null $country Страна, применившая санкции из sanctions_list.country_sanction.id
 * @property DateTimeInterface|null $dateInclusion Дата включения
 * @property DateTimeInterface|null $dateExclusion Дата исключения
 * @property bool $unknownExcDate До распоряжения об отмене санкций
 * @property string|null $basic Основание для введения санкций
 * @property Directive|null $directive Директивы из sanctions_list.directive.id
 * @property DateTimeInterface|null $dateCreate Дата создания записи
 * @property DateTimeInterface|null $dateUpdate Дата обновления записи
 */
#[MongoDB\Document(
    db: 'sanctions_list',
    collection: 'organization',
    repositoryClass: OrganizationRepository::class
)]
#[MongoDB\HasLifecycleCallbacks]
class Organization
{
    /** @var string|null $id Идентификатор */
    #[MongoDB\Id(name: '_id', type: Type::OBJECTID, options: [
        'comment' => 'Идентификатор записи',
    ])]
    private ?string $id = null;

    /** @var string|null $requisite Реквизиты */
    #[MongoDB\Field(type: Type::STRING, nullable: true, options: [
        'fixed' => true,
        'comment' => 'Реквизиты',
    ])]
    #[MongoDB\Index()]
    #[Assert\NotBlank]
    private ?string $requisite = null;

    /** @var string|null $name Наименование */
    #[MongoDB\Field(type: Type::STRING, nullable: true, options: [
        'comment' => 'Наименование',
    ])]
    #[Assert\NotBlank]
    private ?string $name = null;

    /** @var string|null $statusOrg Статус организации */
    #[MongoDB\Field(type: Type::STRING, nullable: true, options: [
        'comment' => 'Статус организации',
    ])]
    private ?string $statusOrg = null;

    /** @var int|null $kartotekaId Идентификатор организации kartoteka_v3_1.organizations */
    #[MongoDB\Field(type: Type::INT, options: [
        'comment' => 'kartoteka_v3_1.organizations - id карточки',
    ])]
    #[MongoDB\Index()]
    private ?int $kartotekaId = null;

    /** @var Country|null $country Страна, применившая санкции из sanctions_list.country_sanction.id */
    #[MongoDB\ReferenceOne(options: [
        'comment' => 'Страна',
    ], targetDocument: Country::class)]
    #[MongoDB\Index()]
    #[Assert\NotBlank]
    private ?Country $country = null;

    /** @var DateTimeInterface|null $dateInclusion Дата включения */
    #[MongoDB\Field(type: Type::DATE_IMMUTABLE, nullable: true, options: [
        'comment' => 'Дата включения',
    ])]
    #[MongoDB\Index()]
    private ?\DateTimeInterface $dateInclusion = null;

    /** @var DateTimeInterface|null $dateExclusion Дата исключения */
    #[MongoDB\Field(type: Type::DATE_IMMUTABLE, nullable: true, options: [
        'comment' => 'Дата исключения',
    ])]
    #[MongoDB\Index()]
    private ?\DateTimeInterface $dateExclusion = null;

    /** @var bool $unknownExcDate До распоряжения об отмене санкций */
    #[MongoDB\Field(type: Type::BOOL, nullable: false, options: [
        'comment' => 'До распоряжения об отмене санкций',
    ])]
    #[MongoDB\Index()]
    private bool $unknownExcDate = false;

    /** @var string|null $basic Основание для введения санкций */
    #[MongoDB\Field(type: Type::STRING, options: [
        'comment' => 'Основание для введения санкций',
    ])]
    private ?string $basic = null;

    /** @var Directive|null $directive Директивы из sanctions_list.directive.id */
    #[MongoDB\ReferenceOne(targetDocument: Directive::class, inversedBy: 'id')]
    #[MongoDB\Index()]
    private ?Directive $directive = null;

    #[MongoDB\ReferenceOne(options: [
        'comment' => 'Пользователь добавивший запись',
    ], targetDocument: User::class)]
    #[MongoDB\Index()]
    #[Assert\NotBlank]
    private ?User $user = null;

    /** @var DateTimeInterface|null $dateCreate Дата создания записи */
    #[MongoDB\Field(type: Type::DATE_IMMUTABLE, options: [
        'comment' => 'Дата создания записи',
    ])]
    #[MongoDB\Index()]
    private ?\DateTimeInterface $dateCreate = null;

    /** @var DateTimeInterface|null $dateUpdate Дата обновления записи */
    #[MongoDB\Field(type: Type::DATE_IMMUTABLE, options: [
        'comment' => 'Дата обновления записи',
    ])]
    #[MongoDB\Index()]
    private ?\DateTimeInterface $dateUpdate = null;

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
     * Получение основания для введения санкций
     *
     * @return string|null
     */
    public function getBasic(): ?string
    {
        return $this->basic;
    }

    /**
     * Установка основания для введения санкций
     *
     * @param string|null $basic Основание для введения санкций
     *
     * @return $this
     */
    public function setBasic(?string $basic): self
    {
        $this->basic = $basic;

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
     * Получение юзера
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Установка юзера
     *
     * @param User $user Юзер, добавивший запись
     *
     * @return $this
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
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