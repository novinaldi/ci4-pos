<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-fw fa-table"></i> Manajemen Data Produk</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-sm btn-primary"
                onclick="window.location='<?= site_url('produk/add') ?>'">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barcode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $nomor = 1;
                    foreach ($dataproduk as $r) :
                    ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $r['kodebarcode']; ?></td>
                        <td><?= $r['namaproduk']; ?></td>
                        <td><?= $r['katnama']; ?></td>
                        <td><?= $r['satnama']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="float-left">
                <?= $pager->links('produk', 'paging_data'); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>