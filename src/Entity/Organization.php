<?php

namespace SanctionList\Entity;

use SanctionList\Repository\OrganizationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @param int|null $id Идентификатор
 * @param string|null $name Наименование
 * @param string|null $requisite Реквизиты
 * @param string|null $status_org Статус организации
 * @param int|null $kartotekaId Идентификатор организации kartoteka_v3_1.organizations
 * @param Country|null $country Страна, применившая санкции из sanctions_list.country_sanction.id
 * @param \DateTimeInterface|null $date_inclusion Дата включения
 * @param \DateTimeInterface|null $date_exclusion Дата исключения
 * @param bool $unknown_exdate До распоряжения об отмене санкций
 * @param Directive|null $directive Директивы из sanctions_list.directive.id
 * @param \DateTimeInterface|null $date_create Дата создания записи
 * @param \DateTimeInterface|null $date_update Дата обновления записи
 */
#[ORM\Entity(repositoryClass: OrganizationRepository::class)]
#[ORM\Table(name: 'orgs')]
class Organization
{
    /**
     * @param int|null $id Идентификатор
     * @param string|null $name Наименование
     * @param string|null $requisite Реквизиты
     * @param string|null $status_org Статус организации
     * @param int|null $kartotekaId Идентификатор организации kartoteka_v3_1.organizations
     * @param Country|null $country Страна, применившая санкции из sanctions_list.country_sanction.id
     * @param \DateTimeInterface|null $date_inclusion Дата включения
     * @param \DateTimeInterface|null $date_exclusion Дата исключения
     * @param bool $unknown_exdate До распоряжения об отмене санкций
     * @param Directive|null $directive Директивы из sanctions_list.directive.id
     * @param \DateTimeInterface|null $date_create Дата создания записи
     * @param \DateTimeInterface|null $date_update Дата обновления записи
     */
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: 'IDENTITY')]
        #[ORM\Column(type: Types::INTEGER, nullable: false, options: ['unsigned' => true])]
        private ?int $id = null,

        #[ORM\Column(type: Types::STRING, length: 500, nullable: true, options: ['comment' => 'Наименование'])]
        #[Assert\NotBlank]
        private ?string $name = null,

        #[ORM\Column(type: Types::STRING, length: 30, nullable: true, options: [
            'fixed' => true,
            'comment' => 'Реквизиты',
        ])]
        #[Assert\NotBlank]
        private ?string $requisite = null,

        #[ORM\Column(type: Types::STRING, length: 50, nullable: true, options: [
            'comment' => 'Статус организации',
        ])]
        private ?string $status_org = null,

        #[ORM\Column(name: 'kartoteka_id', type: Types::INTEGER, options: [
            'comment' => 'kartoteka_v3_1.organizations - id карточки',
        ])]
        private ?int $kartotekaId = null,

        #[ORM\ManyToOne(targetEntity: Country::class, cascade: ['persist'])]
        #[ORM\JoinColumn(name: 'country_sanction_id', referencedColumnName: 'id')]
        #[Assert\NotBlank]
        private ?Country $country = null,

        #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true, options: ['comment' => 'Дата включения'])]
        private ?\DateTimeInterface $date_inclusion = null,

        #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true, options: ['comment' => 'Дата исключения'])]
        private ?\DateTimeInterface $date_exclusion = null,

        #[ORM\Column(name: 'unknown_exdate', type: Types::SMALLINT, nullable: false, options: [
            'comment' => 'До распоряжения об отмене санкций',
        ])]
        private bool $unknown_exdate = false,

        #[ORM\ManyToOne(targetEntity: Directive::class)]
        #[ORM\JoinColumn(name: 'directive_id', referencedColumnName: 'id')]
        private ?Directive $directive = null,

        #[ORM\Column(name: 'dt', type: Types::DATETIME_MUTABLE, options: [
            'default' => 'CURRENT_TIMESTAMP',
            'comment' => 'Дата создания записи',
        ])]
        private ?\DateTimeInterface $date_create = null,

        #[ORM\Column(type: Types::DATETIME_MUTABLE, options: [
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'comment' => 'Дата обновления записи',
        ])]
        private ?\DateTimeInterface $date_update = null
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
        return $this->status_org;
    }

    /**
     * Установка статуса организации
     *
     * @param string|null $status_org Статус организации
     *
     * @return $this
     */
    public function setStatusOrg(?string $status_org): self
    {
        $this->status_org = $status_org;

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
        return $this->date_inclusion;
    }

    /**
     * Установка даты включения
     *
     * @param \DateTimeInterface|null $date_inclusion Дата включения
     *
     * @return $this
     */
    public function setDateInclusion(?\DateTimeInterface $date_inclusion): self
    {
        $this->date_inclusion = $date_inclusion;

        return $this;
    }

    /**
     * Получение даты исключения
     *
     * @return \DateTimeInterface|null
     */
    public function getDateExclusion(): ?\DateTimeInterface
    {
        return $this->date_exclusion;
    }

    /**
     * Установка даты исключения
     *
     * @param \DateTimeInterface|null $date_exclusion Дата исключения
     *
     * @return $this
     */
    public function setDateExclusion(?\DateTimeInterface $date_exclusion): self
    {
        $this->date_exclusion = $date_exclusion;

        return $this;
    }

    /**
     * Получение отметки распоряжения об отмене санкции
     *
     * @return bool
     */
    public function getUnknownExdate(): bool
    {
        return $this->unknown_exdate;
    }

    /**
     * Установка отметки распоряжения об отмене санкции
     *
     * @param bool $unknown_exdate Отметка распоряжения об отмене санкции
     *
     * @return $this
     */
    public function setUnknownExdate(bool $unknown_exdate): self
    {
        $this->unknown_exdate = $unknown_exdate;

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
        return $this->date_create;
    }

    /**
     * Установка даты создания записи
     *
     * @param \DateTimeInterface $date_create Дата создания записи
     *
     * @return $this
     */
    public function setDateCreate(\DateTimeInterface $date_create): self
    {
        $this->date_create = $date_create;

        return $this;
    }

    /**
     * Получение даты обновления записи
     *
     * @return \DateTimeInterface|null
     */
    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->date_update;
    }

    /**
     * Установка даты обновления записи
     *
     * @param \DateTimeInterface $date_update Дата обновления записи
     *
     * @return $this
     */
    public function setDateUpdate(\DateTimeInterface $date_update): self
    {
        $this->date_update = $date_update;

        return $this;
    }
}
