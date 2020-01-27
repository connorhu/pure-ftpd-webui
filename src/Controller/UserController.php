<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\FtpUser;
use App\Entity\Setting;
use App\Forms\Types\FtpUserType;

class UserController extends AbstractController
{
    public function list()
    {
        return $this->render('users/list.html.twig', [
            'users' => $this->getDoctrine()->getRepository(FtpUser::class)->findBy([], ['login' => 'ASC'])
        ]);
    }
    
    protected function handleEdit(FtpUser $user, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(FtpUserType::class, $user);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $isNew = $user->getId() === null;
            
            $password = $form['clear_password']->getData();
            if ($password) {
                $user->setPassword($encoder->encodePassword($user, $password));
            }
            
            $em = $this->getDoctrine()->getManager();
            
            if ($isNew) {
                $em->persist($user);
            }
            
            $em->flush($user);
            
            $this->addFlash('success', $isNew ? 'User created!' : 'User\'s data updated!');
            
            return $this->redirectToRoute('users');
        }
        
        return $this->render('users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    
    protected function handleDelete($user, $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $em->remove($user);
        $em->flush($user);
        
        return $this->redirectToRoute('users');
    }

    public function new(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new FtpUser();
        
        $em = $this->getDoctrine()->getManager();
        $settingRepository = $em->getRepository(Setting::class);
        
        $settings = $settingRepository->getSettingsArray();
        
        if (isset($settings['FTPDUIDefaultDir'])) {
            $user->setUploadDirectory($settings['FTPDUIDefaultDir']);
        }
        
        if (isset($settings['FTPDUIDefaultUID'])) {
            $user->setUid($settings['FTPDUIDefaultUID']);
        }
        
        if (isset($settings['FTPDUIDefaultGID'])) {
            $user->setGid($settings['FTPDUIDefaultGID']);
        }
        
        
        return $this->handleEdit($user, $request, $encoder);
    }

    public function edit($user, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getDoctrine()->getRepository(FtpUser::class)->find($user);
        
        if ($user === null) {
            throw $this->createNotFoundException('User not found');
        }
        
        return $this->handleEdit($user, $request, $encoder);
    }

    public function delete($user, Request $request)
    {
        $user = $this->getDoctrine()->getRepository(FtpUser::class)->find($user);
        
        if ($user === null) {
            throw $this->createNotFoundException('User not found');
        }
        
        return $this->handleDelete($user, $request);
    }
}