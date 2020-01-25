<?php

namespace App\Forms\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as CoreTypes;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('FTPDUIDefaultDir', CoreTypes\TextType::class, [
            'label' => 'Default Upload Directory',
            'required' => false,
        ]);

        $builder->add('FTPDUIDefaultUID', CoreTypes\IntegerType::class, [
            'label' => 'Default UID for new Users',
            'required' => false,
        ]);

        $builder->add('FTPDUIDefaultGID', CoreTypes\IntegerType::class, [
            'label' => 'Default GID for new Users',
            'required' => false,
        ]);

        // $builder->add('FTPDUIDefaultUploadSpeed', CoreTypes\IntegerType::class, [
        //     'label' => 'Default GID for new Users',
        //     'required' => false,
        // ]);
        //
        // $builder->add('FTPDUIDefaultDownloadSpeed', CoreTypes\IntegerType::class, [
        //     'label' => 'Default GID for new Users',
        //     'required' => false,
        // ]);

        $builder->add('save', CoreTypes\SubmitType::class, [
            'label' => 'Save',
        ]);
        
        // FTPDUIDefaultQuotaSize
        // FTPDUIDefaultQuotaFiles
        // FTPDUIDefaultPermittedIP
        
        
    }
}