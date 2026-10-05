<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dashboard Principal<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-gauge"></i> Panel Principal - SIFARMA HGP</h3>
        </div>
        <p style="font-size: 14px; color: var(--text-muted);">
            Bienvenido al Sistema de Control Farmacéutico del <strong>Hospital General Pachuca</strong>.
        </p>
    </div>

    <!-- TARJETAS INFORMATIVAS DE PRUEBA -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px;">
        <div class="card" style="border-left: 4px solid var(--primary-green);">
            <div style="font-size: 12px; color: var(--text-muted); font-weight: 600;">USUARIOS ACTIVOS</div>
            <div style="font-size: 24px; font-weight: 800; color: var(--primary-green); margin-top: 5px;">SIFARMA</div>
            <div style="font-size: 11px; color: var(--text-muted); margin-top: 5px;">Módulo de Usuarios Migrado</div>
        </div>

        <div class="card" style="border-left: 4px solid #10B981;">
            <div style="font-size: 12px; color: var(--text-muted); font-weight: 600;">ESTADO DEL SISTEMA</div>
            <div style="font-size: 24px; font-weight: 800; color: #10B981; margin-top: 5px;">Online</div>
            <div style="font-size: 11px; color: var(--text-muted); margin-top: 5px;">CodeIgniter 4 Framework</div>
        </div>
    </div>

<?= $this->endSection() ?>