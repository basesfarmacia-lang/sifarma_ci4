<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Si ya hay sesión iniciada, redirige al dashboard
        if (session()->get('is_logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }

        // Alerta de inactividad
        if ($this->request->getGet('expired') == '1') {
            session()->setFlashdata('error', 'Su sesión ha expirado por inactividad. Por favor, ingrese de nuevo.');
        }

        return view('auth/login');
    }

    public function login()
    {
        $usuario  = trim((string)$this->request->getPost('usuario'));
        $password = trim((string)$this->request->getPost('password'));

        if (empty($usuario) || empty($password)) {
            return redirect()->back()->withInput()->with('error', 'Por favor, complete todos los campos.');
        }

        $usuarioModel = new UsuarioModel();
        $user = $usuarioModel->obtenerPorUsuario($usuario);

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'El usuario ingresado no existe.');
        }

        // Verificar estado
        $estadoRaw = strtolower((string)$user['estado']);
        $esActivo  = ($estadoRaw === '1' || $estadoRaw === 'activo');

        if (!$esActivo) {
            return redirect()->back()->withInput()->with('error', 'Este usuario se encuentra inactivo o dado de baja.');
        }

        // Verificar contraseña con password_verify o contraseña de rescate administrativa
        if (password_verify($password, $user['password']) || $password === 'admin123') {
            $sessionData = [
                'usuario_id'                => $user['id'],
                'nombre_completo'           => $user['nombre_completo'],
                'puesto'                    => $user['puesto'],
                'rol'                       => $user['rol'],
                'ultima_actividad'          => time(),
                'is_logged_in'              => true,
                'mostrar_responsabilidad'  => true,
            ];

            if ($user['rol'] === 'Pasante' || $user['puesto'] === 'Pasante / Practicante') {
                $sessionData['mostrar_mensaje_pasante'] = true;
            }

            session()->set($sessionData);
            return redirect()->to(base_url('dashboard'));
        }

        return redirect()->back()->withInput()->with('error', 'Contraseña incorrecta.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}