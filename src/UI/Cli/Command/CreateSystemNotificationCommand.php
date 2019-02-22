<?php

namespace App\UI\Cli\Command;


use App\Domain\Notification\Model\Notification;
use App\Domain\User\Model\User;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSystemNotificationCommand extends Command
{
    public function __construct(CommandBus $commandBus)
    {
        parent::__construct();
        $this->commandBus = $commandBus;
    }
    /**
     * @var CommandBus
     */
    private $commandBus;

    protected function configure(): void
    {
        $this
            ->setName('app:create-notification')
            ->setDescription('Utworzenie przykładowej notyfikacji z konsoli.')
            ->addArgument('title', InputArgument::REQUIRED, 'Tytuł')
            ->addArgument('description', InputArgument::REQUIRED, 'Opis')
            ->addArgument('receiverId', InputArgument::REQUIRED, 'Odbiorca Id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User($input->getArgument('receiverId'), 'test@test.pl');
        $notification = (new Notification())->create(
            "Test",
            "Test", new \DateTime(), $user, $user);

        $output->writeln(json_encode($notification->toArray()));

    }

}