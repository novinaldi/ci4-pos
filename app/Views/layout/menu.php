<?= $this->extend('layout/main') ?>

<?= $this->section('menu') ?>
<li class="nav-item">
    <a href="<?= site_url('layout/home') ?>" class="nav-link">
        <i class="nav-icon fa fa-tachometer-alt"></i>
        <p>
            Home
        </p>
    </a>
</li>
<?= $this->endSection(); ?>