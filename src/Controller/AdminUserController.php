<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\AdminUser;
use App\Forms\Types\AdminUserType;

class AdminUserController extends AbstractController
{
    public function list()
    {
        return $this->render('admin_users/list.html.twig', [
            'users' => $this->getDoctrine()->getRepository(AdminUser::class)->findBy([], ['username' => 'ASC'])
        ]);
    }
    
    protected function handleEdit(AdminUser $user, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(AdminUserType::class, $user);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $isNew = $user->getId() === null;
            
            $password = $form['password']->getData();
            if ($password) {
                $user->setPassword($encoder->encodePassword($user, $password));
            }
            
            $em = $this->getDoctrine()->getManager();
            
            if ($isNew) {
                $em->persist($user);
            }
            
            $em->flush($user);
            
            $this->addFlash('success', $isNew ? 'User created!' : 'User\'s data updated!');
            
            return $this->redirectToRoute('admin_users');
        }
        
        return $this->render('admin_users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    
    public function new(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new AdminUser();
        
        return $this->handleEdit($user, $request, $encoder);
    }

    public function edit($user, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getDoctrine()->getRepository(AdminUser::class)->find($user);
        
        if ($user === null) {
            throw $this->createNotFoundException('User not found');
        }
        
        return $this->handleEdit($user, $request, $encoder);
    }
}