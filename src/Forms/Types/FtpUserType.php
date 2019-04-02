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
                'required' => false,
                'label' => 'Login',
            ])
            ->add('active', null, [
                'required' => false,
                'label' => 'Active',
            ])
            ->add('uid', null, [
                'required' => false,
                'label' => 'UID',
            ])
            ->add('gid', null, [
                'required' => false,
                'label' => 'GID',
            ])
            ->add('uploadDirectory', null, [
                'required' => false,
                'label' => 'Upload Directory',
            ])
            ->add('uploadBandwidth', null, [
                'required' => false,
                'label' => 'Upload Bandwidth',
            ])
            ->add('downloadBandwidth', null, [
                'required' => false,
                'label' => 'Download Bandwidth',
            ])
            ->add('ipaccess', null, [
                'required' => false,
                'label' => 'Permitted IP',
            ])
            ->add('quotaSize', null, [
                'required' => false,
                'label' => 'Quota Size',
            ])
            ->add('quotaFiles', null, [
                'required' => false,
                'label' => 'Quota Files',
            ])
            ->add('comment', null, [
                'required' => false,
                'label' => 'Comment',
            ])
            ->add('save', SubmitType::class)
        ;
    }
}