<?php

declare(strict_types=1);

namespace App\Domain\Repository\User;

use App\Domain\Entity\User\User;
use App\Domain\RepositoryFilter\User\UserFilter;

interface UserRepositoryInterface
{
    /**
     * Найти пользователя по фильтру.
     */
    public function findUsers(UserFilter $filter): array;

    /**
     * Найти пользователя по ID.
     *
     * @throws \DomainException
     */
    public function findById(int $id): User;

    /**
     * Сохранить пользователя.
     */
    public function save(User $user): void;

    /**
     * Удалить пользователя.
     */
    public function delete(User $user): void;
}
