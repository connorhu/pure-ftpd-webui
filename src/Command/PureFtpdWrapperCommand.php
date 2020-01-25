<?php

namespace App\Command;

use App\Entity\Setting;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class PureFtpdWrapperCommand extends Command
{
    protected static $defaultName = 'app:ftpd-wrapper';

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $settings = $this->entityManager->getRepository(Setting::class)->getSettingsArray();
        
        foreach (Setting::getFTPDSettingKeys() as $key) {
            if (isset($settings[$key])) {
                $output->write(' '. $settings[$key]);
            }
        }
        
        $output->writeln('');
        
        return 0;
    }
}