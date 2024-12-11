<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tenant</li>
                </ul>
            </div>
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="col ms-0 ms-md-4 p-4 shadow rounded-3 overflow-hidden bg-white">
            <?php if (!empty(session('msg'))) : ?>
            <div class="alert alert-success">
                <div class="d-flex align-items-center justify-content-start">
                    <span class="alert-icon">
                        <i class="anticon anticon-check-o"></i>
                    </span>
                    <span><?= session('msg') ?></span>
                </div>
            </div>
            <?php endif; ?>

            <div class="main-content">
                <div class="row">
                    <!-- Content Wrapper END -->
                    <div class="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <h3 class="fw-bold" style="color:#45b104">Tenant</h3>
                                </div>
                                <div
                                    class="col-md-6 d-flex justify-content-md-end justify-content-end align-items-center">
                                    <div class="mt-3 mt-md-0">
                                        <button type="button" class="btn btn-primary btn-sm-2 rounded"
                                            onclick="openaddModal()">
                                            <i class="mdi mdi-plus me-1"></i>
                                            Tambah Data</button>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-25">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th style="width: 20%">Logo</th>
                                            <th style="width: 30%">Nama Tenant</th>
                                            <th style="width: 30%">Deskripsi</th>
                                            <th style="width: 20%">Nama Owner</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $number = 0; ?>

                                        @foreach ($tenant as $item)
                                            <?php $number++; ?>
                                            <tr>
                                                <td><?= $number ?></td>
                                                <td>
                                                    <img src="{{ $item->logo_tenant }}" alt="Logo Tenant"
                                                        style="width: 80px; height: auto;">
                                                </td>
                                                <td>{{ $item->name_tenant }}</td>
                                                <td>{{ $item->desc_tenant }}</td>
                                                <td>{{ $item->owner_name }}</td>
                                                <td>
                                                    <div class="d-flex flex-row gap-2">
                                                        <button type="button"
                                                            onclick="openviewModal(`<?= htmlentities(json_encode($item)) ?>`)"
                                                            class="btn btn-warning px-4 py-2 rounded">
                                                            <i class="bx bx-edit-alt font-size-16 align-middle">Edit</i>
                                                        </button>
                                                        <button type="button"
                                                            onclick="opendeleteModal(`<?= htmlentities(json_encode($item)) ?>`)"
                                                            class="btn btn-danger px-4 py-2 rounded">
                                                            <i class="bx bx-trash font-size-16 align-middle">Delete</i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
            </div>
        </div>
    </div>
</main>
{{-- Start Modal Add blom --}}
<div class="modal" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Tenant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-tenant" action="<?= url('dashboard-admin/tenant/store') ?>" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label>Logo Tenant<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <div class="custom-file">
                                <input type="file" name="tenant_logo" class="custom-file-input dropify" style="font-size: 10px;"
                                    accept=".jpg, .png, .jpeg" data-allowed-file-extensions="jpg png jpeg" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Tenant<span class="text-danger">*</span></label>
                        <input placeholder="name" type="text" name="tenant_name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Deskripsi<span class="text-danger">*</span></label>
                        <input placeholder="desc" type="text" name="tenant_desc" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Owner<span class="text-danger">*</span></label>
                        <input placeholder="owner" type="text" name="owner_name" class="form-control"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Add --}}

{{-- Start Modal Update blom --}}
<div class="modal" id="updateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Expertise</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-user" action="{{ url ('dashboard-admin/expertise/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="up_id_expertise" value="" readonly>
                    <label>Gambar</label>
                    <div class="custom-file">
                        <input type="file" name="up_image_background" class="custom-file-input dropify"
                            accept=".jpg, .png, .jpeg" data-allowed-file-extensions="jpg png jpeg">
                    </div>
                    <label>Name<span class="text-danger">*</span></label>
                    <input placeholder="name" type="text" name="expertise_name" class="form-control" required>
                    <label>Description<span class="text-danger">*</span></label>
                    <input placeholder="name" type="text" name="expertise_desc" class="form-control" required>
                    <label>Status<span class="text-danger">*</span></label>
                    <input placeholder="status" type="text" name="expertise_status" class="form-control"
                        required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Update --}}

{{-- Start Modal Delete blom --}}
<div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-user" action="{{ url ('dashboard-admin/expertise/delete') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p>Apakah kamu ingin menghapus data ini?</p>
                    <input type="hidden" name="del_id_expertise" value="" readonly>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Delete --}}

<script>
new DataTable('#example');
    // $('#dtTable').DataTable()

    function openaddModal() {
        $('#addModal').modal('show')
    }

    function openviewModal(viewData) {
        var data = JSON.parse(viewData)

        var profile_image = $('input[name="up_image_background"]').dropify();
        profile_image = profile_image.data('dropify');
        profile_image.resetPreview();
        profile_image.clearElement();
        profile_image.settings['defaultFile'] = data.EXPERTISEIMAGE;
        profile_image.destroy();
        profile_image.init();

        $('input[name="expertise_name"]').val(data.EXPERTISENAME)
        $('input[name="expertise_desc"]').val(data.EXPERTISEDESC)
        $('input[name="expertise_status"]').val(data.EXPERTISESTATUS)
        $('input[name="up_id_expertise"]').val(data.EXPERTISEID)

        $('#updateModal').modal('show')
    }

    function opendeleteModal(viewData) {
        var data = JSON.parse(viewData)
        $('input[name="del_id_expertise"]').val(data.EXPERTISEID)
        $('#deleteModal').modal('show')
    }

    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                default: 'Tarik dan lepas gambar disini atau klik',
                replace: 'Ganti',
                remove: 'Hapus',
                error: 'Error'
            },
            error: {
                'fileSize': 'File terlalu besar (1MB maksimal).'
            }
        });
    });
</script>
