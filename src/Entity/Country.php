<?php

namespace SanctionList\Entity;

use SanctionList\Repository\CountryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property  int|null $id Идентификатор записи
 * @property string|null $name Название страны, союза, организации
 * @property string $hash Хэш для уникальности
 * @property int|null $filesLoadId Идентификатор файла из sanctions_list.files_load - id
 * @property \DateTimeInterface|null $date_create Дата создания записи
 * @property \DateTimeInterface|null $date_update Дата обновления записи
 */
#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ORM\Table(name: 'country_sanction')]
#[UniqueEntity(fields: ['hash'], message: 'country.hash_unique', errorPath: 'title')]
class Country
{
    /**
     * @param int|null $id Идентификатор записи
     * @param string|null $name Название страны, союза, организации
     * @param string $hash Хэш для уникальности
     * @param int|null $filesLoadId Идентификатор файла из sanctions_list.files_load - id
     * @param \DateTimeInterface|null $date_create Дата создания записи
     * @param \DateTimeInterface|null $date_update Дата обновления записи
     */
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue(strategy: "IDENTITY")]
        #[ORM\Column(name: 'id', type: Types::SMALLINT, nullable: false, options: [
            'unsigned' => true,
            'comment' => 'Идентификатор записи'
        ])]
        private readonly ?int $id = null,

        #[ORM\Column(name: 'name', type: Types::STRING, length: 150, nullable: false, options: [
            'comment' => 'Название страны, союза, организации'
        ])]
        #[Assert\Length(max: 150, maxMessage: 'Максимум 150 символов')]
        private ?string $name = null,

        #[ORM\Column(name: 'hash', type: Types::STRING, length: 32, nullable: false, options: [
            'comment' => 'Хэш для уникальность'
        ])]
        private ?string $hash = null,

        #[ORM\Column(name: 'files_load_id', type: Types::INTEGER, nullable: true, options: [
            'comment' => 'sanctions_list.files_load - id'
        ])]
        private ?int $filesLoadId = null,

        #[ORM\Column(name: 'dt', type: Types::DATETIME_MUTABLE, options: [
            'default' => 'CURRENT_TIMESTAMP',
            'comment' => 'Дата создания записи'
        ])]
        private ?\DateTimeInterface $date_create = null,

        #[ORM\Column(name: 'date_update', type: Types::DATETIME_MUTABLE, options: [
            'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'comment' => 'Дата обновления записи'
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
     * Получение хэша
     *
     * @return string|null
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * Установка хэша
     *
     * @param string|null $hash Хэш для уникальности
     *
     * @return $this
     */
    public function setHash(?string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Получение идентификатора загруженного файла
     *
     * @return int|null
     */
    public function getFileLoadId(): ?int
    {
        return $this->filesLoadId;
    }

    /**
     * Установка идентификатора загруженного файла
     *
     * @param int $fileLoadId Идентификатор загруженного файла
     *
     * @return $this
     */
    public function setFileLoadId(int $fileLoadId): self
    {
        $this->filesLoadId = $fileLoadId;

        return $this;
    }

    /**
     * Получение даты создания
     *
     * @return \DateTimeInterface|null
     */
    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->date_create;
    }

    /**
     * Установка даты создания
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
     * Получение даты обновления
     *
     * @return \DateTimeInterface|null
     */
    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->date_update;
    }

    /**
     * Установка даты обновления
     *
     * @param \DateTimeInterface $date_update Дата обновления
     *
     * @return $this
     */
    public function setDateUpdate(\DateTimeInterface $date_update): self
    {
        $this->date_update = $date_update;

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
