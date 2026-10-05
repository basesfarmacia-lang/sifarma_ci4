<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Todos los campos asignables según tu tabla
    protected $allowedFields    = [
        'nombre_completo',
        'curp',
        'num_trabajador',
        'financiamiento',
        'puesto',
        'cedula_profesional',
        'institucion_titulo',
        'usuario',
        'password',
        'rol',
        'estado'
    ];

    // Buscar un usuario específico para la autenticación
    public function obtenerPorUsuario(string $usuario)
    {
        return $this->where('usuario', $usuario)->first();
    }

    // Verificar duplicado de usuario o CURP
    public function existeUsuarioOCurp(string $usuario, string $curp): bool
    {
        return $this->where('usuario', $usuario)
                    ->orWhere('curp', $curp)
                    ->countAllResults() > 0;
    }

    // Obtener todos los usuarios ordenados descendente
    public function obtenerTodos()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }
}