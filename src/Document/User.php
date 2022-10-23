<?php

namespace SanctionList\Document;

use SanctionList\Repository\UserRepository;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ODM\MongoDB\Types\Type;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

#[MongoDB\Document(db: 'sanctions_list', collection: 'user', repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @param string|null $id Идентификатор записи
     * @param string|null $fullName Имя пользователя
     * @param string|null $username Логин пользователя
     * @param string|null $email Email пользователя
     * @param string|null $password Пароль пользователя
     * @param array|null $roles Роль пользователя
     */
    public function __construct(
        #[MongoDB\Id(name: '_id', type: Type::BINDATAUUIDRFC4122, options: [
            'comment' => 'Идентификатор записи',
        ])]
        private ?string $id = null,

        #[MongoDB\Field(type: Type::STRING, options: ['comment' => 'Имя пользователя'])]
        #[Assert\NotBlank]
        private ?string $fullName = null,

        #[MongoDB\Field(type: Type::STRING, options: ['comment' => 'Логин пользователя'])]
        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 50)]
        private ?string $username = null,

        #[MongoDB\Field(type: Type::STRING, options: ['comment' => 'Email пользователя'])]
        #[Assert\Email]
        private ?string $email = null,

        #[MongoDB\Field(type: Type::STRING, options: ['comment' => 'Пароль пользователя'])]
        private ?string $password = null,

        #[MongoDB\Field(type: Type::COLLECTION, options: ['comment' => 'Роль пользователя'])]
        private ?array  $roles = []
    ) {}

    /**
     * Получение Идентификатора записи
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Получение Имени пользователя
     *
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * Установка Имени пользователя
     *
     * @param string $fullName Имя пользователя
     *
     * @return void
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * Получение идентифицированного пользователя
     *
     * @return string
     */
    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    /**
     * Получение Логина пользователя
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->getUserIdentifier();
    }

    /**
     * Установка Логина пользователя
     *
     * @param string $username Логин пользователя
     *
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * Получение Email пользователя
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Установка Email пользователя
     *
     * @param string $email Email пользователя
     *
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Получение Пароля пользователя
     *
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Установка Пароля пользователя
     *
     * @param string $password Пароль пользователя
     *
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Получение Роли пользователя
     *
     * @return array|string[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    /**
     * Установка Роли пользователя
     *
     * @param array $roles Роль пользователя
     *
     * @return void
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * {@inheritdoc}
     */
    public function getSalt(): ?string
    {
        // We're using bcrypt in security.yaml to encode the password, so
        // the salt value is built-in and you don't have to generate one
        // See https://en.wikipedia.org/wiki/Bcrypt

        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // if you had a plainPassword property, you'd nullify it here
        // $this->plainPassword = null;
    }

    /**
     * Сериализация данных
     *
     * @return array
     */
    public function __serialize(): array
    {
        // add $this->salt too if you don't use Bcrypt or Argon2i
        return [$this->id, $this->username, $this->password];
    }

    /**
     * Десериализация данных
     *
     * @param array $data Данные для десериализации
     *
     * @return void
     */
    public function __unserialize(array $data): void
    {
        // add $this->salt too if you don't use Bcrypt or Argon2i
        [$this->id, $this->username, $this->password] = $data;
    }
}