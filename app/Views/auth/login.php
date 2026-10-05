<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIFARMA - Inicio de Sesión</title>
    <!-- FontAwesome e Inter Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-body: #ECEFEF;            
            --primary-green: #0C6E53;     
            --primary-hover: #084E3A;     
            --accent-green: #10B981;      
            --text-dark: #1F2937;         
            --text-muted: #6B7280;        
            --border-color: #D1D5DB;      
            --input-bg: #F9FAFB;          
            --danger-bg: #FEE2E2;         
            --danger-text: #991B1B;
            --success-bg: #D1FAE5;
            --success-text: #065F46;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            background-color: #e2e8f0; 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: #FFFFFF;
            width: 100%;
            max-width: 450px;
            padding: 35px 32px;
            border-radius: 16px;
            border: 1px solid #E5E7EB;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
        }

        .logo-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 22px;
            padding-bottom: 18px;
            border-bottom: 1px solid #F3F4F6;
        }

        .logo-img {
            max-height: 52px;
            max-width: 48%;
            width: auto;
            object-fit: contain;
        }

        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-header h1 {
            font-size: 24px;
            color: var(--primary-green);
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .login-header p.subtitle {
            font-size: 13px;
            color: var(--text-dark);
            font-weight: 500;
            margin-top: 4px;
        }

        .login-header p.hospital-name {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
            font-weight: 400;
        }

        .alert-error {
            background-color: var(--danger-bg);
            border: 1px solid #FCA5A5;
            color: var(--danger-text);
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
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
            margin-bottom: 20px;
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

    <div class="login-card">
        <div class="logo-container">
            <img src="<?= base_url('assets/img/Logo1.png') ?>" alt="IMSS BIENESTAR" class="logo-img">
            <img src="<?= base_url('assets/img/Logo2.png') ?>" alt="GOBIERNO DE MÉXICO" class="logo-img">
        </div>

        <div class="login-header">
            <h1>SIFARMA</h1>
            <p class="subtitle">Sistema de Inventario Farmaceutico Avanzado</p>
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