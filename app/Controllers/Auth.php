<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function login()
    {
        // 1. Si viene por expiración de inactividad, destruir la sesión primero
        if ($this->request->getGet('expired') == '1') {
            session()->destroy();
            return view('auth/login', [
                'error' => 'Tu sesión ha caducado por inactividad. Por favor, ingresa de nuevo.'
            ]);
        }

        // 2. Si ya está autenticado (y no viene expirado), redirigir al Dashboard
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }

        return view('auth/login');
    }

    public function procesarLogin()
    {
        $session  = session();
        $model    = new UsuarioModel();

        $usuario  = trim($this->request->getPost('usuario') ?? '');
        $password = trim($this->request->getPost('password') ?? '');

        if (empty($usuario) || empty($password)) {
            return redirect()->back()->with('error', 'Por favor ingresa usuario y contraseña.')->withInput();
        }

        // Buscar el usuario en la BD
        $userData = $model->where('usuario', $usuario)->first();

        if ($userData) {
            // Verificar si el usuario está activo
            $estado = strtolower(trim((string)($userData['estado'] ?? '0')));
            if (!in_array($estado, ['1', 'activo', 'active'])) {
                return redirect()->back()->with('error', 'El usuario se encuentra inactivo. Contacta al administrador.')->withInput();
            }

            // Verificar la contraseña
            if (password_verify($password, $userData['password'])) {
                // Guardar los datos del usuario en la sesión
                $sessionData = [
                    'usuario_id'            => $userData['id'],
                    'nombre_completo'       => $userData['nombre_completo'],
                    'usuario'               => $userData['usuario'],
                    'rol'                   => $userData['rol'] ?? 'Personal',
                    'puesto'                => $userData['puesto'] ?? '',
                    'logged_in'             => true,
                    'mostrar_responsabilidad' => true, // <-- Activa el modal al iniciar sesión
                ];

                $session->set($sessionData);
                return redirect()->to(base_url('dashboard'));
            }
        }

        return redirect()->back()->with('error', 'Usuario o contraseña incorrectos.')->withInput();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('mensaje', 'Has cerrado sesión correctamente.');
    }
}