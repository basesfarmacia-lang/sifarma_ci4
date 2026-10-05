<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - SIFARMA HGP</title>
    
    <!-- FontAwesome & Fuentes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-body: #F4F6F5;            
            --bg-sidebar: #FFFFFF;         
            --primary-green: #0C6E53;     
            --primary-hover: #084E3A;
            --accent-green: #10B981;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
            --hover-bg: #F0FDF4;          
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-main); display: flex; height: 100vh; overflow: hidden; }

        /* Sidebar */
        .sidebar { width: 260px; background-color: var(--bg-sidebar); border-right: 1px solid var(--border-color); display: flex; flex-direction: column; transition: all 0.3s ease; z-index: 100; height: 100vh; flex-shrink: 0; }
        .sidebar.collapsed { margin-left: -260px; }
        .sidebar-header { padding: 18px 20px; border-bottom: 1px solid var(--border-color); background-color: #FFFFFF; }
        .sidebar-header a { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .sidebar-header i { font-size: 24px; color: var(--primary-green); }
        .sidebar-header h2 { font-size: 18px; font-weight: 800; color: var(--primary-green); letter-spacing: 0.5px; }

        .menu-list { list-style: none; padding: 15px 10px; overflow-y: auto; flex: 1; }
        .menu-item { margin-bottom: 4px; }
        .menu-link { display: flex; align-items: center; justify-content: space-between; padding: 12px 15px; color: var(--text-main); text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; transition: background 0.2s, color 0.2s; }
        .menu-link:hover { background-color: var(--hover-bg); color: var(--primary-green); }
        .menu-link .left-content { display: flex; align-items: center; gap: 12px; }
        .menu-link i.main-icon { font-size: 16px; width: 20px; text-align: center; color: var(--primary-green); }
        .arrow-icon { font-size: 12px; transition: transform 0.3s ease; color: var(--text-muted); }

        .submenu { list-style: none; max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; padding-left: 20px; }
        .submenu li a { display: flex; align-items: center; gap: 8px; padding: 8px 15px; color: var(--text-muted); text-decoration: none; font-size: 13px; border-radius: 6px; transition: color 0.2s, background 0.2s; }
        .submenu li a:hover { color: var(--primary-green); background-color: var(--hover-bg); font-weight: 500; }
        .menu-item.active .submenu { max-height: 300px; }
        .menu-item.active .arrow-icon { transform: rotate(180deg); }

        /* Contenedor Principal */
        .main-wrapper { flex: 1; display: flex; flex-direction: column; height: 100vh; overflow: hidden; }
        
        /* Navbar Superior */
        .top-navbar { height: 60px; background-color: var(--primary-green); border-bottom: 1px solid var(--primary-hover); display: flex; align-items: center; justify-content: space-between; padding: 0 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08); flex-shrink: 0; z-index: 90; }
        .navbar-left { display: flex; align-items: center; gap: 15px; }
        .hamburger-btn { background: none; border: none; font-size: 20px; color: #FFFFFF; cursor: pointer; padding: 6px; border-radius: 6px; transition: background 0.2s; }
        .hamburger-btn:hover { background-color: var(--primary-hover); }
        .navbar-title { font-size: 16px; font-weight: 700; color: #FFFFFF; letter-spacing: 0.2px; user-select: none; }

        .user-section { display: flex; align-items: center; gap: 15px; }
        .user-profile { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #FFFFFF; }
        .user-info { display: flex; flex-direction: column; text-align: right; }
        .user-name { font-weight: 600; color: #FFFFFF; }
        .user-role { font-size: 11px; color: #A7F3D0; font-weight: 500; }

        .btn-logout { color: #EF4444; background: #FFFFFF; border: 1px solid #FCA5A5; padding: 7px 12px; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 600; display: flex; align-items: center; gap: 6px; transition: background 0.2s, color 0.2s; }
        .btn-logout:hover { background: #FEF2F2; color: #DC2626; }

        /* Banner Calidad Hospitalaria */
        .fixed-quality-wrapper { padding: 15px 25px 5px 25px; background-color: var(--bg-body); flex-shrink: 0; z-index: 85; }
        .hospital-quality-bar { background-color: #FFFFFF; border: 1px solid var(--border-color); border-left: 4px solid var(--primary-green); border-radius: 8px; padding: 10px 16px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; font-size: 12px; color: var(--text-muted); box-shadow: 0 1px 2px rgba(0,0,0,0.03); }
        .quality-item { display: flex; align-items: center; gap: 8px; }
        .quality-item i { color: var(--primary-green); font-size: 13px; }
        .quality-item strong { color: var(--text-main); font-weight: 600; }
        .clues-badge { background-color: var(--hover-bg); color: var(--primary-green); padding: 2px 8px; border-radius: 4px; font-weight: 700; font-family: monospace; border: 1px solid #A7F3D0; }

        /* Contenido Dinámico */
        .content-area { padding: 15px 25px 20px 25px; flex: 1; display: flex; flex-direction: column; gap: 20px; overflow-y: auto; }

        .card { background-color: #FFFFFF; border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); flex-shrink: 0; }
        .card-header { margin-bottom: 18px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px; }
        .card-header h3 { font-size: 16px; color: var(--primary-green); font-weight: 700; display: flex; align-items: center; gap: 8px; }

        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px; }
        .form-group { margin-bottom: 5px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: var(--text-main); margin-bottom: 5px; }
        .form-control { width: 100%; padding: 9px 12px; font-size: 13px; border: 1px solid var(--border-color); border-radius: 6px; outline: none; transition: border 0.2s; }
        .form-control:focus { border-color: var(--primary-green); box-shadow: 0 0 0 3px rgba(12, 110, 83, 0.1); }

        .farmaceutico-box { display: none; grid-column: 1 / -1; background-color: #F0FDF4; border: 1px solid #A7F3D0; padding: 15px; border-radius: 8px; margin-top: 5px; }
        .farmaceutico-box .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }

        .btn-submit { background-color: var(--primary-green); color: white; border: none; padding: 11px 20px; font-weight: 600; font-size: 13px; border-radius: 6px; cursor: pointer; transition: background 0.2s; display: inline-flex; justify-content: center; align-items: center; gap: 8px; margin-top: 15px; }
        .btn-submit:hover { background-color: var(--primary-hover); }

        .table-responsive-scroll { max-height: 440px; overflow-y: auto; overflow-x: auto; border: 1px solid var(--border-color); border-radius: 8px; margin-top: 10px; }
        .table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: 12px; text-align: left; }
        .table th { position: sticky; top: 0; z-index: 10; background-color: #EAF7F2; color: var(--primary-green); font-weight: 700; padding: 12px; border-bottom: 2px solid #A7F3D0; white-space: nowrap; }
        .table td { padding: 10px 12px; border-bottom: 1px solid var(--border-color); color: var(--text-main); vertical-align: middle; background-color: #FFFFFF; }
        .table tr:hover td { background-color: #F9FAFB; }

        .badge-tag { padding: 2px 7px; border-radius: 4px; font-size: 11px; font-weight: 600; display: inline-block; }
        .tag-base { background-color: #DEF7EC; color: #03543F; }
        .tag-contrato { background-color: #E1EFFE; color: #1E429F; }
        .tag-formalizado { background-color: #FDF2E9; color: #B43403; }
        .tag-regularizado { background-color: #F3E8FF; color: #6B21A8; }
        .tag-na { background-color: #F3E8FF; color: #6B21A8; border: 1px solid #E9D5FF; }
        .tag-inactivo { background-color: #F3F4F6; color: #9CA3AF; border: 1px solid #D1D5DB; }

        .badge-role { padding: 3px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; }
        .role-admin { background-color: #FEF3C7; color: #D97706; }
        .role-farmaceutico { background-color: #D1FAE5; color: #047857; }
        .role-personal { background-color: #F3F4F6; color: #374151; }
        .role-pasante { background-color: #F3E8FF; color: #6B21A8; border: 1px solid #E9D5FF; }

        .action-btns { display: flex; align-items: center; gap: 6px; }
        .inline-form { display: inline; margin: 0; padding: 0; }
        .btn-action { display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-warning { background-color: #FEF3C7; color: #D97706; border: 1px solid #FCD34D; }
        .btn-warning:hover { background-color: #FDE68A; }
        .btn-success { background-color: #D1FAE5; color: #047857; border: 1px solid #6EE7B7; }
        .btn-success:hover { background-color: #A7F3D0; }
        .btn-danger { background-color: #FEE2E2; color: #DC2626; border: 1px solid #FCA5A5; }
        .btn-danger:hover { background-color: #FCA5A5; color: #991B1B; }

        .alert { padding: 10px 14px; border-radius: 6px; font-size: 12px; margin-bottom: 15px; font-weight: 500; }
        .alert-success { background-color: #D1FAE5; color: #065F46; border: 1px solid #A7F3D0; }
        .alert-error { background-color: #FEE2E2; color: #991B1B; border: 1px solid #FCA5A5; }

        .footer-credits { height: 40px; background-color: #FFFFFF; padding: 0 25px; font-size: 12px; color: var(--text-muted); display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-color); flex-shrink: 0; z-index: 80; }
        .footer-credits .author { color: var(--primary-green); font-weight: 600; }
    </style>
    
    <?= $this->renderSection('styles') ?>
</head>
<body>

    <!-- MENÚ LATERAL (SIDEBAR) -->
    <?= $this->include('partials/sidebar') ?>

    <!-- ÁREA PRINCIPAL -->
    <div class="main-wrapper">
        <!-- BARRA SUPERIOR -->
        <?= $this->include('partials/topbar') ?>

        <!-- BANNER DE CALIDAD FIJO -->
        <?= $this->include('partials/quality_bar') ?>

        <!-- CONTENIDO DINÁMICO DE LA VISTA -->
        <main class="content-area">
            <?= $this->renderSection('content') ?>
        </main>

        <!-- FOOTER -->
        <div class="footer-credits">
            <span>&copy; <?= date('Y') ?> Farmacia HGP</span>
            <span class="author">By @Jonathan Alexis Vallejo Téllez</span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const sidebar = document.getElementById('sidebar');

            if (hamburgerBtn && sidebar) {
                hamburgerBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('collapsed');
                });
            }
        });

        function toggleSubmenu(element) {
            const parentItem = element.parentElement;
            document.querySelectorAll('.menu-item').forEach(item => {
                if (item !== parentItem) {
                    item.classList.remove('active');
                }
            });
            parentItem.classList.toggle('active');
        }
    </script>

    <!-- SWEETALERT2 PARA ALERTAS INTERACTIVAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- MODAL DE ADVERTENCIA AL INGRESAR -->
    <?php if (session()->get('mostrar_responsabilidad')): ?>
        <?php session()->remove('mostrar_responsabilidad'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Aviso Importante de Responsabilidad!',
                    html: `<div style="text-align: justify; font-size: 14px; color: #374151; line-height: 1.5;">
                            <p style="margin-bottom: 10px;">Al ingresar al sistema con sus credenciales, usted se hace responsable de <strong>toda modificación, registro, alteración o cambio</strong> realizado bajo su cuenta.</p>
                            <p>Por seguridad operativa, no comparta su usuario ni su contraseña con terceros; son estrictamente personales e intransferibles.</p>
                           </div>`,
                    icon: 'warning',
                    confirmButtonText: 'Entendido y Acepto',
                    confirmButtonColor: '#0C6E53',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
            });
        </script>
    <?php endif; ?>

    <!-- CONTROL AUTOMÁTICO DE INACTIVIDAD (2 MINUTOS RIGUROSOS) -->
    <script>
    (function () {
        const TIEMPO_MAXIMO_MS = 120000; // 2 minutos exactos (120,000 ms)
        let ultimaActividad = Date.now();

        function registrarActividad() {
            ultimaActividad = Date.now();
        }

        // Escuchar eventos en fase de captura global (incluye clics en modales y tablas)
        const eventos = ['mousedown', 'keydown', 'scroll', 'touchstart', 'click'];
        eventos.forEach(function(evento) {
            document.addEventListener(evento, registrarActividad, true);
        });

        // Verificación por reloj real cada 1 segundo (independiente de congelamientos de pestaña)
        const intervaloControl = setInterval(function() {
            const tiempoInactivo = Date.now() - ultimaActividad;
            
            if (tiempoInactivo >= TIEMPO_MAXIMO_MS) {
                clearInterval(intervaloControl);
                
                // Remover event listeners
                eventos.forEach(function(evento) {
                    document.removeEventListener(evento, registrarActividad, true);
                });

                // Redirección directa al Login
                window.location.href = "<?= base_url('login?expired=1') ?>";
            }
        }, 1000);
    })();
    </script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>