<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SessionTimeoutFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if ($session->get('is_logged_in')) {
            $lastActivity = $session->get('ultima_actividad');
            $currentTime  = time();
            $timeout      = 120; // 2 minutos (120 segundos)

            if ($lastActivity) {
                // Si el tiempo transcurrido superó el límite de 120s
                if (($currentTime - $lastActivity) > $timeout) {
                    $session->destroy();
                    return redirect()->to(base_url('login?expired=1'));
                }
            }

            // Solo si pasa la validación, actualizamos el timestamp
            $session->set('ultima_actividad', $currentTime);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // ...
    }
}