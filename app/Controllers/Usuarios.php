<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    protected $session;
    protected $usuarioModel;

    public function __construct()
    {
        $this->session = session();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        // Verificación de Rol Administrador
        if ($this->session->get('rol') !== 'Administrador') {
            return redirect()->to('dashboard')->with('error', 'No tienes permisos de administrador para acceder a esta sección.');
        }

        $data = [
            'nombre_usuario' => $this->session->get('nombre_completo') ?? 'Usuario',
            'rol_usuario'    => $this->session->get('rol') ?? 'Administrador',
            'lista_usuarios' => $this->usuarioModel->obtenerTodos(),
            'mensaje'        => $this->session->getFlashdata('mensaje'),
            'error'          => $this->session->getFlashdata('error'),
        ];

        return view('usuarios/index', $data);
    }

    // Procesar Creación de Usuario
    public function crear()
    {
        if ($this->session->get('rol') !== 'Administrador') {
            return redirect()->to('login');
        }

        // Reglas de validación nativas de CodeIgniter 4
        $rules = [
            'nombre_completo' => 'required|min_length[3]|max_length[150]',
            'curp'            => 'required|exact_length[18]',
            'financiamiento'  => 'required',
            'puesto'          => 'required',
            'usuario'         => 'required|min_length[3]|max_length[50]',
            'password'        => 'required|min_length[4]',
            'rol'             => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Por favor, verifica los campos obligatorios.');
        }

        $nombreCompleto = trim((string)$this->request->getPost('nombre_completo'));
        $curp           = strtoupper(trim((string)$this->request->getPost('curp')));
        $numTrabajador  = trim((string)$this->request->getPost('num_trabajador'));
        $financiamiento = (string)$this->request->getPost('financiamiento');
        $puesto         = (string)$this->request->getPost('puesto');

        $requiereCedula    = ($puesto !== 'Auxiliar Administrativo' && $puesto !== 'Pasante / Practicante');
        $cedulaProfesional = $requiereCedula ? trim((string)$this->request->getPost('cedula_profesional')) : null;
        $institucionTitulo = $requiereCedula ? trim((string)$this->request->getPost('institucion_titulo')) : null;

        $usuario  = trim((string)$this->request->getPost('usuario'));
        $password = (string)$this->request->getPost('password');
        $rol      = (string)$this->request->getPost('rol');

        // Validar duplicidad
        if ($this->usuarioModel->existeUsuarioOCurp($usuario, $curp)) {
            return redirect()->back()->withInput()->with('error', 'El nombre de usuario o la CURP ya se encuentran registrados en el sistema.');
        }

        $datosGuardar = [
            'nombre_completo'    => $nombreCompleto,
            'curp'               => $curp,
            'num_trabajador'     => $numTrabajador ?: null,
            'financiamiento'     => $financiamiento,
            'puesto'             => $puesto,
            'cedula_profesional' => $cedulaProfesional ?: null,
            'institucion_titulo' => $institucionTitulo ?: null,
            'usuario'            => $usuario,
            'password'           => password_hash($password, PASSWORD_BCRYPT),
            'rol'                => $rol,
            'estado'             => 1
        ];

        if ($this->usuarioModel->insert($datosGuardar)) {
            return redirect()->to('usuarios')->with('mensaje', 'Usuario registrado correctamente con su expediente laboral.');
        }

        return redirect()->back()->withInput()->with('error', 'No se pudo registrar el usuario en la base de datos.');
    }

    // Cambiar Estado (Activar / Dar de Baja)
    public function cambiarEstado()
    {
        if ($this->session->get('rol') !== 'Administrador') {
            return redirect()->to('login');
        }

        $idUser           = (int) $this->request->getPost('id');
        $estadoSolicitado = strtolower(trim((string)$this->request->getPost('estado')));
        $esActivar        = ($estadoSolicitado === 'activo' || $estadoSolicitado === '1');
        $nuevoEstado      = $esActivar ? 1 : 0;

        if ($idUser === (int)$this->session->get('usuario_id')) {
            return redirect()->to('usuarios')->with('error', 'No puedes inactivar la cuenta con la que mantienes sesión activa.');
        }

        if ($idUser > 0) {
            $this->usuarioModel->update($idUser, ['estado' => $nuevoEstado]);
            $mensaje = 'El estado del usuario ha sido actualizado a: ' . ($esActivar ? 'ACTIVO' : 'INACTIVO');
            return redirect()->to('usuarios')->with('mensaje', $mensaje);
        }

        return redirect()->to('usuarios');
    }

    // Eliminar Usuario
    public function eliminar()
    {
        if ($this->session->get('rol') !== 'Administrador') {
            return redirect()->to('login');
        }

        $idUser = (int) $this->request->getPost('id');

        if ($idUser === (int)$this->session->get('usuario_id')) {
            return redirect()->to('usuarios')->with('error', 'No puedes eliminar la cuenta con la que tienes sesión iniciada.');
        }

        if ($idUser > 0) {
            try {
                $this->usuarioModel->delete($idUser);
                return redirect()->to('usuarios')->with('mensaje', 'Usuario eliminado permanentemente de la base de datos.');
            } catch (\Exception $e) {
                return redirect()->to('usuarios')->with('error', "No se puede eliminar el usuario porque existen registros asociados a su expediente. Se recomienda 'Dar de baja' en su lugar.");
            }
        }

        return redirect()->to('usuarios');
    }
}