<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserUpdater
 */
class UserUpdater
{
    private UserPasswordHasherInterface $passwordHasher;

    private EntityManagerInterface $entityManager;

    private UserRepository $userRepository;

    public function __construct(
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository
    ) {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    public function createUser(string $email, string $plainPassword, string $role = 'ROLE_USER'): User
    {
        $now = new DateTime();
        $user = (new User())
            ->setEmail($email)
            ->setRoles([$role])
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
        ;

        $this->validateUser($user);

        $user->setPassword($this->passwordHasher->hashPassword($user, $plainPassword));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function validateUser(User $user): void
    {
        $existingUser = $this->userRepository->findOneBy(['email' => $user->getEmail()]);

        if (null !== $existingUser) {
            throw new RuntimeException('There is already a user registered with this email.');
        }
    }
}
