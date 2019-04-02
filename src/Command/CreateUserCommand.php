<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\AdminUser;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';

    public function __construct(ObjectManager $entityManager, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct();
        
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        
        $question = new Question('Please enter the first admin\'s user name: ');
        $username = $helper->ask($input, $output, $question);

        $question = new Question('Please enter the first admin\'s user password: ');
        $question->setHidden(true);
        $question->setHiddenFallback(false);
        
        $password = $helper->ask($input, $output, $question);

        $user = new AdminUser();
        $user->setLanguage('en');
        $user->setUsername($username);
        $user->setPassword($this->encoder->encodePassword($user, $password));
        
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
        $output->writeln('done');
    }
}