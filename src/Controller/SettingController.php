<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\Setting;
use App\Forms\Types\SettingsType;

class SettingController extends AbstractController
{
    public function settings(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $settingRepository = $em->getRepository(Setting::class);

        $form = $this->createForm(SettingsType::class, $settingRepository->getSettingsArray());
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            $settings = $settingRepository->getSettings();
            
            foreach ($data as $settingName => $value) {
                if (!isset($settings[$settingName])) {
                    $setting = $settings[$settingName] = new Setting();
                    $setting->setName($settingName);
                    $setting->setValue($value);
                    
                    $em->persist($setting);
                }
                else {
                    $settings[$settingName]->setValue($value);
                }
            }
            
            $em->flush();
            
            $this->addFlash('success', 'Settings saved successfull!');
            
            return $this->redirectToRoute('settings');
        }
        
        return $this->render('settings/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}