<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="<?= base_url('dashboard') ?>" title="Regresar al inicio">
            <i class="fa-solid fa-hospital"></i>
            <h2>SIFARMA - HGP</h2>
        </a>
    </div>

    <ul class="menu-list">
        <li class="menu-item">
            <div class="menu-link" onclick="toggleSubmenu(this)">
                <div class="left-content">
                    <i class="fa-solid fa-chart-pie main-icon"></i>
                    <span>Dashboard y Reportes</span>
                </div>
                <i class="fa-solid fa-chevron-down arrow-icon"></i>
            </div>
            <ul class="submenu">
                <li><a href="<?= base_url('dashboard') ?>"><i class="fa-solid fa-gauge"></i> Resumen General</a></li>
                <li><a href="#"><i class="fa-solid fa-file-invoice"></i> Reportes de Stock</a></li>
                <li><a href="#"><i class="fa-solid fa-right-left"></i> Entradas y Salidas</a></li>
            </ul>
        </li>

        <li class="menu-item active">
            <div class="menu-link" onclick="toggleSubmenu(this)">
                <div class="left-content">
                    <i class="fa-solid fa-sliders main-icon"></i>
                    <span>Configuración</span>
                </div>
                <i class="fa-solid fa-chevron-down arrow-icon"></i>
            </div>
            <ul class="submenu">
                <li><a href="<?= base_url('usuarios') ?>" style="color: var(--primary-green); font-weight: 600;"><i class="fa-solid fa-users"></i> Usuarios y Roles</a></li>
                <li><a href="#"><i class="fa-solid fa-capsules"></i> Catálogo Medicamentos</a></li>
                <li><a href="#"><i class="fa-solid fa-gear"></i> Parámetros Sistema</a></li>
            </ul>
        </li>
    </ul>
</aside>