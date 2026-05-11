<?= $this->include('template/admin_header'); ?>

<div class="admin-header">
    <h2>Data Artikel (AJAX)</h2>
    <div class="action-cell">
        <input type="text" id="ajaxSearch" class="form-control" placeholder="Cari di tabel..." style="width: 200px; height: 40px;">
        <button type="button" id="btnTambah" class="btn btn-default">+ Tambah Artikel</button>
    </div>
</div>

<div class="table-wrapper">
    <table class="modern-table" id="artikelTable">
        <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th style="width: 80px;">Media</th>
                <th>Judul Artikel</th>
                <th>Kategori</th>
                <th>Status</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="artikelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: var(--r-md); border: none; box-shadow: var(--shadow-lg);">
            <div class="modal-header" style="border-bottom: 1px solid var(--c-border); padding: var(--sp-6);">
                <h5 class="modal-title" id="modalTitle" style="font-family: var(--f-display);">Tambah Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="artikelForm" enctype="multipart/form-data">
                <div class="modal-body" style="padding: var(--sp-6);">
                    <input type="hidden" name="id" id="artikelId">
                    <div class="form-group mb-4">
                        <label class="form-label" style="font-weight: 600;">JUDUL ARTIKEL</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                        <div class="invalid-feedback text-danger text-xs mt-1" id="err_judul"></div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" style="font-weight: 600;">KATEGORI</label>
                        <select name="id_kategori" id="id_kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback text-danger text-xs mt-1" id="err_id_kategori"></div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" style="font-weight: 600;">ISI ARTIKEL</label>
                        <textarea name="isi" id="isi" rows="6" class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label" style="font-weight: 600;">GAMBAR / VIDEO</label>
                        <input type="file" name="gambar" id="gambar" class="form-control">
                        <small class="text-muted" id="fileHint">Biarkan kosong jika tidak ingin mengubah media.</small>
                        <div class="invalid-feedback text-danger text-xs mt-1" id="err_gambar"></div>
                    </div>
                    <div id="mediaPreview" class="mt-3"></div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--c-border); padding: var(--sp-4) var(--sp-6);">
                    <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="btnSubmit" class="btn btn-default">Simpan Artikel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        const modal = new bootstrap.Modal(document.getElementById('artikelModal'));

        function showLoadingMessage() {
            $('#artikelTable tbody').html('<tr><td colspan="6" class="text-center text-muted">Memuat data artikel...</td></tr>');
        }

        function loadData() {
            showLoadingMessage();
            $.ajax({
                url: "<?= base_url('ajax/data') ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    var tableBody = "";
                    for (var i = 0; i < data.length; i++) {
                        var row = data[i];
                        var statusClass = row.status == 1 ? 'status-published' : 'status-draft';
                        var statusText = row.status == 1 ? 'Published' : 'Draft';

                        tableBody += '<tr>';
                        tableBody += '<td>' + row.id + '</td>';
                        
                        // Kolom Media
                        tableBody += '<td>';
                        if (row.gambar) {
                            var isVideo = row.gambar.toLowerCase().endsWith('.mp4');
                            if (isVideo) {
                                tableBody += '<video src="<?= base_url('gambar/app/') ?>' + row.gambar + '" style="width:60px; height:45px; object-fit:cover; border-radius:var(--r-sm);" muted></video>';
                            } else {
                                tableBody += '<img src="<?= base_url('gambar/app/') ?>' + row.gambar + '" style="width:60px; height:45px; object-fit:cover; border-radius:var(--r-sm);">';
                            }
                        }
                        tableBody += '</td>';

                        tableBody += '<td class="title-cell">' + row.judul + '</td>';
                        tableBody += '<td><span class="badge badge-edit">' + (row.nama_kategori || 'Uncategorized') + '</span></td>';
                        tableBody += '<td><span class="status-pill ' + statusClass + '">' + statusText + '</span></td>';
                        tableBody += '<td style="text-align: center;">';
                        tableBody += '<div class="action-cell">';
                        tableBody += '<button class="btn btn-warning btn-sm btn-edit" data-id="' + row.id + '">EDIT</button>';
                        tableBody += '<button class="btn btn-danger btn-sm btn-delete" data-id="' + row.id + '">DELETE</button>';
                        tableBody += '</div>';
                        tableBody += '</td>';
                        tableBody += '</tr>';
                    }
                    if (data.length === 0) {
                        tableBody = '<tr><td colspan="6" class="text-center text-muted">Tidak ada data artikel.</td></tr>';
                    }
                    $('#artikelTable tbody').html(tableBody);
                }
            });
        }

        loadData();

        // Filter Pencarian
        $('#ajaxSearch').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $("#artikelTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        function clearErrors() {
            $('.invalid-feedback').text('');
            $('.form-control, .form-select').removeClass('is-invalid');
        }

        // Buka Modal Tambah
        $('#btnTambah').on('click', function() {
            clearErrors();
            $('#artikelForm')[0].reset();
            $('#artikelId').val('');
            $('#modalTitle').text('Tambah Artikel Baru');
            $('#fileHint').text('Pilih gambar atau video untuk artikel ini.');
            $('#mediaPreview').html('');
            modal.show();
        });

        // Buka Modal Edit
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?= base_url('ajax/detail/') ?>" + id,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#artikelId').val(data.id);
                    $('#judul').val(data.judul);
                    $('#id_kategori').val(data.id_kategori);
                    $('#isi').val(data.isi);
                    $('#modalTitle').text('Edit Artikel');
                    
                    if(data.gambar) {
                        var ext = data.gambar.split('.').pop().toLowerCase();
                        var previewHtml = '<p class="text-sm text-muted mb-2">Media saat ini:</p>';
                        if(ext === 'mp4') {
                            previewHtml += '<video src="<?= base_url('gambar/app/') ?>' + data.gambar + '" style="max-height: 100px; border-radius: var(--r-sm);" muted autoplay loop></video>';
                        } else {
                            previewHtml += '<img src="<?= base_url('gambar/app/') ?>' + data.gambar + '" style="max-height: 100px; border-radius: var(--r-sm);">';
                        }
                        $('#mediaPreview').html(previewHtml);
                    } else {
                        $('#mediaPreview').html('');
                    }
                    modal.show();
                }
            });
        });

        // Preview File Saat Dipilih
        $('#gambar').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let html = '<p class="text-sm text-muted mb-2">Pratinjau file baru:</p>';
                    if (file.type.includes('video')) {
                        html += '<video src="' + e.target.result + '" style="max-height: 100px; border-radius: var(--r-sm);" muted autoplay loop></video>';
                    } else {
                        html += '<img src="' + e.target.result + '" style="max-height: 100px; border-radius: var(--r-sm);">';
                    }
                    $('#mediaPreview').html(html);
                }
                reader.readAsDataURL(file);
            }
        });

        // Submit Form (Add atau Update)
        $('#artikelForm').on('submit', function(e) {
            e.preventDefault();
            clearErrors();
            var id = $('#artikelId').val();
            var url = id ? "<?= base_url('ajax/update/') ?>" + id : "<?= base_url('ajax/add') ?>";
            var formData = new FormData(this);

            $('#btnSubmit').prop('disabled', true).text('Memproses...');

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    $('#btnSubmit').prop('disabled', false).text('Simpan Artikel');
                    if (response.status === 'OK') {
                        modal.hide();
                        loadData();
                        alert(response.message);
                    } else {
                        $.each(response.errors, function(key, val) {
                            $('#err_' + key).text(val);
                            $('#' + key).addClass('is-invalid');
                        });
                    }
                },
                error: function() { $('#btnSubmit').prop('disabled', false).text('Simpan Artikel'); }
            });
        });

        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
                $.ajax({
                    url: "<?= base_url('ajax/delete/') ?>" + id,
                    method: "DELETE",
                    success: function (data) {
                        loadData();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error deleting article: ' + textStatus + errorThrown);
                    }
                });
            }
            console.log('Delete button clicked for ID:', id);
        });
    });
</script>
<?= $this->include('template/admin_footer'); ?>
