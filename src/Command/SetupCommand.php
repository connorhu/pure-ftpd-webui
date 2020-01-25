<?php

namespace App\Command;

use App\Entity\Setting;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class SetupCommand extends Command
{
    protected static $defaultName = 'app:setup';

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $settings = $this->entityManager->getRepository(Setting::class)->getSettingsArray();
        
        foreach (Setting::getFTPDSettingKeys() as $key) {
            if (!isset($settings[$key])) {
                $setting = new Setting();
                $setting->setName($key);
                $setting->setValue(Setting::getDefaultValueForKey($key));
                $this->entityManager->persist($setting);
                $this->entityManager->flush($setting);
            }
        }
        
        foreach (Setting::getFTPDUISettingKeys() as $key) {
            if (!isset($settings[$key])) {
                $setting = new Setting();
                $setting->setName($key);
                $setting->setValue(Setting::getDefaultValueForKey($key));
                $this->entityManager->persist($setting);
                $this->entityManager->flush($setting);
            }
        }
        
        $output->writeln('done');
        
        return 0;
    }
}