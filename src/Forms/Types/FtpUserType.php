<?php

namespace App\Forms\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FtpUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', null, [
                'label' => 'Login',
            ])
            ->add('active', null, [
                'label' => 'Active',
            ])
            ->add('uid', null, [
                'label' => 'UID',
            ])
            ->add('gid', null, [
                'label' => 'GID',
            ])
            ->add('uploadDirectory', null, [
                'label' => 'Upload Directory',
            ])
            ->add('uploadBandwidth', null, [
                'label' => 'Upload Bandwidth',
            ])
            ->add('downloadBandwidth', null, [
                'label' => 'Download Bandwidth',
            ])
            ->add('ipaccess', null, [
                'label' => 'Permitted IP',
            ])
            ->add('quotaSize', null, [
                'label' => 'Quota Size',
            ])
            ->add('quotaFiles', null, [
                'label' => 'Quota Files',
            ])
            ->add('comment', null, [
                'label' => 'Comment',
            ])
            ->add('save', SubmitType::class)
        ;
    }
}