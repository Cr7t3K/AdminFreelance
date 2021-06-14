<?php

namespace App\Command;

use App\Security\UserUpdater;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class CreateUserCommand
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class CreateUserCommand extends Command
{
    private SymfonyStyle $io;

    private UserUpdater $userUpdater;

    protected static $defaultName = 'app:create-user';

    public function __construct(UserUpdater $userUpdater, string $name = null)
    {
        parent::__construct($name);
        $this->userUpdater = $userUpdater;
    }

    public function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Create new user.')
            ->addArgument('email', InputArgument::OPTIONAL, 'The email of the user.')
            ->addArgument('password', InputArgument::OPTIONAL, 'User password')
        ;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $this->io->title('User Creator');
        $this->io->writeln([
            '============',
            '',
        ]);

        $email = $input->getArgument('email');
        if (null !== $email) {
            $this->io->text('> <info>Email :</info>'.$email);
        } else {
            $email = $this->io->ask('Email');
            $input->setArgument('email', $email);
        }

        $password = $input->getArgument('password');
        if (null !== $password) {
            $this->io->text('> <info>Password :</info>'.$password);
        } else {
            $password = $this->io->ask('Password');
            $input->setArgument('password', $password);
        }

        $retypePassword = $this->io->ask('Retype password');
        while ($password !== $retypePassword) {
            $this->io->error('This is not the same password');
            $retypePassword = $this->io->ask('Retype password');
        }
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');
        $plainPassword = $input->getArgument('password');

        $this->userUpdater->createUser($email, $plainPassword);

        $this->io->success('User was successfully created !');
        $this->io->text(sprintf('Email: %s', $email));
        $this->io->text(sprintf('Password: %s', $plainPassword));

        return Command::SUCCESS;
    }
}
