<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIFARMA - Inicio de Sesión</title>
    <!-- FontAwesome e Inter Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --gob-guinda: #691C32;
            --primary-green: #0C6E53;
            --primary-green-bold: #095641; /* Verde semifuerte */
            --primary-hover: #084E3A;     
            --accent-green: #10B981;      
            --accent-gold: #B38E5D;       /* Dorado de la barra decorativa */
            --text-dark: #1F2937;         
            --text-muted: #6B7280;        
            --border-color: #D1D5DB;      
            --input-bg: #F9FAFB;          
            --danger-bg: #FEE2E2;         
            --danger-text: #991B1B;
            --success-bg: #D1FAE5;
            --success-text: #065F46;

            /* =========================================================
               APARTADO DE AJUSTES DE TAMAÑO Y VISIBILIDAD DE LOGOS
               ========================================================= */
            --logo3-overlay-opacity: 0.40; 
            --logo1-max-height: 200px; 
            --logo1-max-width: 100%;   
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            background-color: #ECEFEF; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 85px 20px 65px 20px;
        }

        /* Barra Superior Guinda */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 65px;
            background-color: var(--gob-guinda);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        }

        /* Barra Inferior Guinda */
        .bottom-navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40px;
            background-color: var(--gob-guinda);
            z-index: 1000;
        }

        /* Convertir imágenes/logos a blanco */
        .img-white {
            filter: brightness(0) invert(1);
        }

        /* Logos más grandes en la barra superior */
        .top-navbar img.gob-logo {
            height: 48px;
            object-fit: contain;
        }

        .top-navbar img.imss-logo-nav {
            height: 44px;
            object-fit: contain;
        }

        /* Tarjeta Login con mayor sombra */
        .login-card {
            background: #FFFFFF;
            width: 100%;
            max-width: 420px;
            border-radius: 20px;
            border: 1px solid #E5E7EB;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            overflow: hidden;
        }

        /* Encabezado usando Logo3 como fondo con opacidad ajustable */
        .card-header-green {
            background: linear-gradient(
                rgba(12, 110, 83, var(--logo3-overlay-opacity)), 
                rgba(12, 110, 83, var(--logo3-overlay-opacity))
            ), 
            url('<?= base_url("assets/img/Logo3.jpg") ?>') center/cover no-repeat;
            padding: 30px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-bottom: 4px solid var(--accent-gold);
        }

        /* Ajustes específicos para el Logo1 sobrepuesto */
        .card-header-green img.header-logo-front {
            max-height: var(--logo1-max-height);
            max-width: var(--logo1-max-width);
            object-fit: contain;
            filter: brightness(0) invert(1) drop-shadow(0px 2px 4px rgba(0, 0, 0, 0.5));
            transition: all 0.2s ease;
        }

        .card-body {
            padding: 28px 28px 25px 28px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

        /* SIFARMA con verde semifuerte */
        .login-header h1 {
            font-size: 24px;
            color: var(--primary-green-bold);
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .login-header p.subtitle {
            font-size: 13px;
            color: var(--text-dark);
            font-weight: 600;
            margin-top: 4px;
        }

        .login-header p.hospital-name {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
            font-weight: 400;
        }

        /* Contenedor Título "INICIO DE SESIÓN" */
        .session-title-container {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 22px;
        }

        /* Título Inicio de Sesión con verde semifuerte */
        .session-title-container .section-title {
            font-size: 15px;
            color: var(--primary-green-bold);
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
            padding-bottom: 8px;
        }

        /* Línea bicolor dividida al 50% (Verde semifuerte y Dorado) */
        .session-title-container .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 140%; /* Más ancha para pasar el texto */
            height: 3px;
            background: linear-gradient(
                to right, 
                var(--primary-green-bold) 0%, 
                var(--primary-green-bold) 50%, 
                var(--accent-gold) 50%, 
                var(--accent-gold) 100%
            );
            border-radius: 2px;
        }

        .alert-error {
            background-color: var(--danger-bg);
            border: 1px solid #FCA5A5;
            color: var(--danger-text);
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-success {
            background-color: var(--success-bg);
            border: 1px solid #A7F3D0;
            color: var(--success-text);
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-dark); margin-bottom: 6px; }

        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-wrapper i.icon-left { position: absolute; left: 14px; color: var(--primary-green); font-size: 15px; }
        
        .input-wrapper input {
            width: 100%;
            padding: 11px 40px 11px 40px;
            font-size: 14px;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            outline: none;
            transition: all 0.2s ease;
            color: var(--text-dark);
        }

        .input-wrapper input:focus {
            background-color: #FFFFFF;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(12, 110, 83, 0.15);
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 4px;
            font-size: 14px;
            transition: color 0.2s ease;
        }

        .toggle-password:hover {
            color: var(--primary-green);
        }

        .btn-submit {
            width: 100%;
            background-color: var(--primary-green);
            color: #FFFFFF;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(12, 110, 83, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #F3F4F6;
        }

        .login-footer p { font-size: 12px; color: var(--text-muted); font-weight: 500; }
        .login-footer .author { font-size: 11px; color: var(--primary-green); font-weight: 600; margin-top: 4px; }
    </style>
</head>
<body>

    <!-- Header Guinda Estilo Gobierno -->
    <header class="top-navbar">
        <img src="<?= base_url('assets/img/Logo2.png') ?>" alt="Gobierno de México" class="gob-logo img-white">
        <img src="<?= base_url('assets/img/Logo1.png') ?>" alt="IMSS Bienestar" class="imss-logo-nav img-white">
    </header>

    <div class="login-card">
        <!-- Encabezado con imagen de fondo Logo3 y el logo frontal Logo1 -->
        <div class="card-header-green">
            <img src="<?= base_url('assets/img/Logo1.png') ?>" alt="IMSS BIENESTAR" class="header-logo-front">
        </div>

        <div class="card-body">
            <div class="login-header">
                <h1>SIFARMA</h1>
                <p class="subtitle">Sistema de Inventario Farmacéutico Avanzado</p>
                <p class="hospital-name">Hospital General de Pachuca</p>
            </div>

            <!-- Manejo de Errores en CodeIgniter 4 -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['expired']) && $_GET['expired'] == 1): ?>
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Su sesión ha expirado por inactividad. Por favor, ingrese de nuevo.</span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span><?= session()->getFlashdata('mensaje') ?></span>
                </div>
            <?php endif; ?>

            <!-- Leyenda INICIO DE SESIÓN Ubicada por debajo de los mensajes -->
            <div class="session-title-container">
                <div class="section-title">Inicio de Sesión</div>
            </div>

            <form action="<?= base_url('login/procesar') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-user icon-left"></i>
                        <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario" value="<?= old('usuario') ?>" required autocomplete="off" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock icon-left"></i>
                        <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
                        <button type="button" class="toggle-password" id="btnTogglePassword" title="Mostrar/Ocultar contraseña">
                            <i class="fa-solid fa-eye" id="iconEye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-right-to-bracket"></i> Iniciar Sesión
                </button>
            </form>

            <div class="login-footer">
                <p>&copy; <?= date('Y') ?> SIFARMA - Farmacia HGP</p>
                <p class="author">by @Jonathan Alexis Vallejo Téllez</p>
            </div>
        </div>
    </div>

    <!-- Franja Guinda Inferior -->
    <footer class="bottom-navbar"></footer>

    <script>
        document.getElementById('btnTogglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const iconEye = document.getElementById('iconEye');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                iconEye.classList.remove('fa-eye');
                iconEye.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                iconEye.classList.remove('fa-eye-slash');
                iconEye.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>