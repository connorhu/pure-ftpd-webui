<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function dashboard()
    {
        return $this->render('dashboard.html.twig', [
            'tab' => '',
            'version' => '0.4.0',
        ]);
    }
}