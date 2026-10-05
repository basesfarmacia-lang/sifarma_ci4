<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Gestión de Usuarios<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-id-card-clip"></i> Alta de Personal y Usuario</h3>
        </div>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?= esc($mensaje) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-error"><i class="fa-solid fa-circle-exclamation"></i> <?= esc($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= base_url('usuarios/crear') ?>">
            <?= csrf_field() ?>

            <div class="form-grid">
                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo *</label>
                    <input type="text" id="nombre_completo" name="nombre_completo" class="form-control" value="<?= old('nombre_completo') ?>" placeholder="Nombre completo" required>
                </div>

                <div class="form-group">
                    <label for="curp">CURP *</label>
                    <input type="text" id="curp" name="curp" class="form-control" maxlength="18" value="<?= old('curp') ?>" placeholder="18 caracteres" style="text-transform:uppercase;" required>
                </div>

                <div class="form-group">
                    <label for="num_trabajador">No. de Trabajador / Matrícula</label>
                    <input type="text" id="num_trabajador" name="num_trabajador" class="form-control" value="<?= old('num_trabajador') ?>" placeholder="Ej. 102938">
                </div>

                <div class="form-group">
                    <label for="financiamiento">Fuente de Financiamiento *</label>
                    <select id="financiamiento" name="financiamiento" class="form-control" required>
                        <option value="Base">Base</option>
                        <option value="Contrato">Contrato</option>
                        <option value="Formalizado">Formalizado</option>
                        <option value="Regularizado">Regularizado</option>
                        <option value="N/A (Pasante)">N/A (Pasante / Beca)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="puesto">Puesto / Perfil *</label>
                    <select id="puesto" name="puesto" class="form-control" required>
                        <option value="Auxiliar Administrativo">Auxiliar Administrativo</option>
                        <option value="Farmacéutico (Lic. en Farmacia)">Farmacéutico (Lic. en Farmacia)</option>
                        <option value="Licenciado">Licenciado</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Ingeniero">Ingeniero</option>
                        <option value="Pasante / Practicante">Pasante / Practicante</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="rol">Rol en Sistema *</label>
                    <select id="rol" name="rol" class="form-control" required>
                        <option value="Personal">Personal / Auxiliar</option>
                        <option value="Farmacéutico">Farmacéutico</option>
                        <option value="Pasante">Pasante / Servicio Social</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>

                <div id="seccion_farmaceutico" class="farmaceutico-box">
                    <div style="font-size: 13px; font-weight: 700; color: var(--primary-green); margin-bottom: 10px;">
                        <i class="fa-solid fa-graduation-cap"></i> Acreditación Profesional / Cédula
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="cedula_profesional">Cédula Profesional *</label>
                            <input type="text" id="cedula_profesional" name="cedula_profesional" class="form-control" value="<?= old('cedula_profesional') ?>" placeholder="Ej. 12345678">
                        </div>
                        <div class="form-group">
                            <label for="institucion_titulo">Institución que Expide Título *</label>
                            <input type="text" id="institucion_titulo" name="institucion_titulo" class="form-control" value="<?= old('institucion_titulo') ?>" placeholder="Ej. UAEH, UNAM, IPN">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="usuario">Nombre de Usuario (Login) *</label>
                    <input type="text" id="usuario" name="usuario" class="form-control" value="<?= old('usuario') ?>" placeholder="Ej. jvallejo" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña *</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-floppy-disk"></i> Guardar Expediente de Usuario
            </button>
        </form>
    </div>

    <div class="card" style="display: flex; flex-direction: column;">
        <div class="card-header">
            <h3><i class="fa-solid fa-users"></i> Plantilla de Personal Registrada</h3>
        </div>

        <div class="table-responsive-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>CURP / No. Trab.</th>
                        <th>Financiamiento</th>
                        <th>Puesto / Profesión</th>
                        <th>Cédula / Inst.</th>
                        <th>Usuario / Rol</th>
                        <th>Estado</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($lista_usuarios)): ?>
                        <?php foreach ($lista_usuarios as $row): 
                            $estado_raw  = trim((string)($row['estado'] ?? '0'));
                            $estado_norm = strtolower($estado_raw);
                            $es_activo   = ($estado_norm === '1' || $estado_norm === 'activo' || $estado_norm === 'active');
                            
                            $numTrab     = !empty($row['num_trabajador']) ? $row['num_trabajador'] : 'S/N';
                            $puestoTxt   = !empty($row['puesto']) ? $row['puesto'] : 'Auxiliar';
                            $instTitulo  = !empty($row['institucion_titulo']) ? $row['institucion_titulo'] : '';
                            $estiloFila  = (!$es_activo) ? 'opacity: 0.65; background-color: #FAFADA;' : '';
                        ?>
                            <tr style="<?= $estiloFila ?>">
                                <td><strong><?= esc($row['nombre_completo'] ?? '') ?></strong></td>
                                <td>
                                    <code><?= esc($row['curp'] ?? 'N/A') ?></code><br>
                                    <span style="font-size:11px; color:var(--text-muted);">No: <?= esc($numTrab) ?></span>
                                </td>
                                <td>
                                    <?php 
                                        $fin = $row['financiamiento'] ?? 'Base';
                                        $tagClass = 'tag-base';
                                        if ($fin === 'Contrato') $tagClass = 'tag-contrato';
                                        if ($fin === 'Formalizado') $tagClass = 'tag-formalizado';
                                        if ($fin === 'Regularizado') $tagClass = 'tag-regularizado';
                                        if (strpos($fin, 'N/A') !== false || $fin === 'Pasante') $tagClass = 'tag-na';
                                    ?>
                                    <span class="badge-tag <?= $tagClass ?>"><?= esc($fin) ?></span>
                                </td>
                                <td><?= esc($puestoTxt) ?></td>
                                <td>
                                    <?php if (!empty($row['cedula_profesional'])): ?>
                                        <i class="fa-solid fa-id-badge" style="color:var(--primary-green);"></i> Céd: <strong><?= esc($row['cedula_profesional']) ?></strong><br>
                                        <span style="font-size:10px; color:var(--text-muted);"><?= esc($instTitulo) ?></span>
                                    <?php else: ?>
                                        <span style="color:var(--text-muted);">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <code><?= esc($row['usuario'] ?? '') ?></code><br>
                                    <?php 
                                        $rolVal = $row['rol'] ?? 'Personal';
                                        $rClass = 'role-personal';
                                        if ($rolVal === 'Administrador') $rClass = 'role-admin';
                                        if ($rolVal === 'Farmacéutico') $rClass = 'role-farmaceutico';
                                        if ($rolVal === 'Pasante') $rClass = 'role-pasante';
                                    ?>
                                    <span class="badge-role <?= $rClass ?>"><?= esc($rolVal) ?></span>
                                </td>
                                <td>
                                    <?php if ($es_activo): ?>
                                        <span class="badge-tag tag-base"><i class="fa-solid fa-circle-check"></i> Activo</span>
                                    <?php else: ?>
                                        <span class="badge-tag tag-inactivo"><i class="fa-solid fa-user-xmark"></i> Baja</span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php if ((int)($row['id'] ?? 0) !== (int)session('usuario_id')): ?>
                                        <div class="action-btns" style="justify-content: center;">
                                            <?php if ($es_activo): ?>
                                                <form method="POST" action="<?= base_url('usuarios/cambiar-estado') ?>" class="inline-form" onsubmit="return confirm('¿Seguro que deseas DAR DE BAJA a este usuario?');">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <input type="hidden" name="estado" value="inactivo">
                                                    <button type="submit" class="btn-action btn-warning" title="Dar de baja (Inactivar)">
                                                        <i class="fa-solid fa-user-slash"></i>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form method="POST" action="<?= base_url('usuarios/cambiar-estado') ?>" class="inline-form" onsubmit="return confirm('¿Seguro que deseas REACTIVAR el acceso a este usuario?');">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <input type="hidden" name="estado" value="activo">
                                                    <button type="submit" class="btn-action btn-success" title="Reactivar usuario">
                                                        <i class="fa-solid fa-user-check"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>

                                            <form method="POST" action="<?= base_url('usuarios/eliminar') ?>" class="inline-form" onsubmit="return confirm('ATENCIÓN: ¿Estás seguro de ELIMINAR permanentemente a este usuario de la base de datos?');">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <button type="submit" class="btn-action btn-danger" title="Eliminar registro">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <span style="color:var(--text-muted); font-size:11px; font-style:italic;">(Sesión actual)</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 20px;">
                                No hay expedientes registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectPuesto = document.getElementById('puesto');
        if (selectPuesto) {
            selectPuesto.addEventListener('change', (e) => {
                toggleFarmaceuticoFields(e.target.value);
            });
            toggleFarmaceuticoFields(selectPuesto.value);
        }
    });

    function toggleFarmaceuticoFields(puesto) {
        const box = document.getElementById('seccion_farmaceutico');
        const inputCedula = document.getElementById('cedula_profesional');
        const inputInst = document.getElementById('institucion_titulo');
        const selectFinanciamiento = document.getElementById('financiamiento');
        const selectRol = document.getElementById('rol');

        if (puesto === 'Pasante / Practicante') {
            if (selectFinanciamiento) selectFinanciamiento.value = 'N/A (Pasante)';
            if (selectRol) selectRol.value = 'Pasante';
        }

        if (puesto !== 'Auxiliar Administrativo' && puesto !== 'Pasante / Practicante') {
            if (box) box.style.display = 'block';
            if (inputCedula) inputCedula.setAttribute('required', 'required');
            if (inputInst) inputInst.setAttribute('required', 'required');
        } else {
            if (box) box.style.display = 'none';
            if (inputCedula) {
                inputCedula.removeAttribute('required');
                inputCedula.value = '';
            }
            if (inputInst) {
                inputInst.removeAttribute('required');
                inputInst.value = '';
            }
        }
    }
</script>
<?= $this->endSection() ?>