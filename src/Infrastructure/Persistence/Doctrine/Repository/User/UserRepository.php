<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository\User;

use App\Domain\Entity\User\User;
use App\Domain\Repository\User\UserRepositoryInterface;
use App\Domain\RepositoryFilter\User\UserFilter;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectRepository;

class UserRepository implements UserRepositoryInterface
{
    private ObjectRepository $repository;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(User::class);
    }

    private function qbAll(UserFilter $filter): QueryBuilder
    {
        $ex = $this->em->getExpressionBuilder();
        $qb = $this->em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u');

        if (null !== $filter->state) {
            $qb->andWhere($ex->eq('u.state', ':state'))
                ->setParameter('state', $filter->state);
        }

        return $qb;
    }

    public function findUsers(UserFilter $filter): array
    {
        return $this
            ->qbAll($filter)
            ->getQuery()
            ->getResult();
    }

    public function findById(int $id): User
    {
        $user = $this->repository->find($id);
        if (!$user instanceof User) {
            throw new \DomainException('User not found.');
        }

        return $user;
    }

    public function save(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function delete(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }
}
