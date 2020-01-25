<?php

namespace App\Entity\Repositories;

use Doctrine\ORM\EntityRepository;

class SettingRepository extends EntityRepository
{
    public function getSettings() : array
    {
        $settings = $this->findAll();
        
        $buffer = [];
        foreach ($settings as $setting) {
            $buffer[$setting->getName()] = $setting;
        }
        
        return $buffer;
    }
    
    public function getSettingsArray() : array
    {
        $settings = $this->findAll();
        
        $buffer = [];
        foreach ($settings as $setting) {
            $buffer[$setting->getName()] = $setting->getValue();
        }
        
        return $buffer;
    }
}