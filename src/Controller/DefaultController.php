<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends AbstractController
{
    public function dashboard()
    {
        return $this->render('dashboard.html.twig', [
            'sessions' => $this->readSessionInformations(),
            'version' => '0.1 alpha7',
        ]);
    }


    protected function readSessionInformations()
    {
        $rows = [];
        $content = @file_get_contents('http://localhost:3000');
        
        if ($content !== false) {
            $sessions = json_decode($content, true); // TODO: replace this with syfmony/http-client when it will stable
        
            if (count($sessions) > 0) {
                foreach ($sessions as $session) {
                    list($pid, $account, $time, $state, $file, $clientHost, $serverIP, $serverPort, $currentSize, $totalSize, $resumed, $bandwith) = $session;
                
                    $rows[] = [
                        'pid' => $pid,
                        'user' => $account,
                        'elapsed_time' => $time,
                        'state' => trim($state),
                        'loaded_file' => $file,
                        'client_host' => $clientHost,
                        'server_ip' => $serverIP,
                        'server_port' => $serverPort,
                        'current_size' => (int) $currentSize,
                        'total_size' => (int) $totalSize,
                        'resumed' => (bool) $resumed,
                        'bandwith' => (int) $bandwith,
                    ];
                }
            }
        }
        
        return $rows;
    }

    public function activeSessions()
    {
        return new JsonResponse($this->readSessionInformations());
    }
}