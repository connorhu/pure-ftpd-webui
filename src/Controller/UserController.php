<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\FtpUser;
use App\Forms\Types\FtpUserType;

class UserController extends AbstractController
{
    public function list()
    {
        return $this->render('users/list.html.twig', [
            'users' => $this->getDoctrine()->getRepository(FtpUser::class)->findBy([], ['login' => 'ASC'])
        ]);
    }

    public function edit($user, Request $request)
    {
        $user = $this->getDoctrine()->getRepository(FtpUser::class)->find($user);
        
        if ($user === null) {
            throw $this->createNotFoundException('User not found');
        }
        
        $form = $this->createForm(FtpUserType::class, $user);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success', 'User\'s data updated!');
            
            return $this->redirectToRoute('users');
        }
        
        return $this->render('users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    
}