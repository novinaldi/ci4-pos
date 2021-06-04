<?= $this->extend('layout/menu') ?>

<?= $this->section('judul') ?>
<h3>Manajemen Data Kategori</h3>
<?= $this->endSection() ?>


<?= $this->section('isi') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-sm btn-primary tombolTambah">
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
            <form method="POST" action="/kategori/index">
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Nama Kategori" name="carikategori"
                        autofocus value="<?= $cari; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="tombolkategori">Cari</button>
                    </div>
                </div>
            </form>

            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>#</th>
                    </tr>
                </thead>


                <tbody>
                    <?php $nomor = 1 + (($nohalaman - 1) * 10);
                    foreach ($datakategori as $row) :
                    ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $row['katnama']; ?></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" title="Hapus Kategori"
                                onclick="hapus('<?= $row['katid'] ?>','<?= $row['katnama'] ?>')">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-sm" title="Edit Kategori"
                                onclick="edit('<?= $row['katid'] ?>')">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="float-center">
                <?= $pager->links('kategori', 'paging_data'); ?>
            </div>
        </div>


    </div>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
function hapus(id, nama) {
    Swal.fire({
        title: 'Hapus Kategori',
        html: `Yakin hapus nama kategori <strong>${nama}</strong> ini ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus !',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "<?= site_url('kategori/hapus') ?>",
                data: {
                    idkategori: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        window.location.reload();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    })
}

function edit(id) {
    $.ajax({
        type: "post",
        url: "<?= site_url('kategori/formEdit') ?>",
        data: {
            idkategori: id
        },
        dataType: "json",
        success: function(response) {
            if (response.data) {
                $('.viewmodal').html(response.data).show();
                $('#modalformedit').on('shown.bs.modal', function(event) {
                    $('#namakategori').focus();
                });
                $('#modalformedit').modal('show');
            }
        },
        error: function(xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}


$(document).ready(function() {
    $('.tombolTambah').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: "<?= site_url('kategori/formTambah') ?>",
            dataType: "json",
            type: 'post',
            data: {
                aksi: 0
            },
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambahkategori').on('shown.bs.modal', function(event) {
                        $('#namakategori').focus();
                    });
                    $('#modaltambahkategori').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
});
</script>
<?= $this->endSection() ?>