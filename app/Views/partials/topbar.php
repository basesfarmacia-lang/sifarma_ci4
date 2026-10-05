<header class="top-navbar">
    <div class="navbar-left">
        <button class="hamburger-btn" id="hamburgerBtn" title="Ocultar/Mostrar Menú">
            <i class="fa-solid fa-bars"></i>
        </button>
        <span class="navbar-title">Sistema de Inventario Farmaceutico Avanzado HGP</span>
    </div>

    <div class="user-section">
        <div class="user-profile">
            <i class="fa-solid fa-circle-user fa-2xl" style="color: #FFFFFF;"></i>
            <div class="user-info">
                <span class="user-name"><?= esc(session('nombre_completo') ?? 'Usuario') ?></span>
                <span class="user-role"><?= esc(session('rol') ?? 'Personal') ?></span>
            </div>
        </div>
        <a href="<?= base_url('logout') ?>" class="btn-logout" title="Cerrar Sesión">
            <i class="fa-solid fa-right-from-bracket"></i> Salir
        </a>
    </div>
</header>