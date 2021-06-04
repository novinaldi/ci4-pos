<?= $this->extend('layout/main') ?>

<?= $this->section('menu') ?>
<li class="nav-item">
    <a href="<?= site_url('layout/index') ?>" class="nav-link">
        <i class="nav-icon fa fa-tachometer-alt"></i>
        <p>
            Home
        </p>
    </a>
</li>
<li class="nav-header">Master</li>
<li class="nav-item">
    <a href="<?= site_url('kategori/index') ?>" class="nav-link">
        <i class="nav-icon fa fa-tasks"></i>
        <p>
            Kategori
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= site_url('satuan/index') ?>" class="nav-link">
        <i class="nav-icon fa fa-tasks"></i>
        <p>
            Satuan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= site_url('produk/index') ?>" class="nav-link">
        <i class="nav-icon fa fa-table"></i>
        <p>
            Produk
        </p>
    </a>
</li>
<?= $this->endSection(); ?>