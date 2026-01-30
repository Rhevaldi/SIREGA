@extends('layouts.app')

@section('title', 'Tambah Media Warga')
@section('page-title', 'Tambah Media Warga')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title mt-1">Form Tambah Media Warga</h3>
            <div class="card-tools">
                <a href="{{ route('media_warga.index') }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Daftar Media
                </a>
            </div>
        </div>

        <div class="card-body">
            <form id="media-warga-form" onsubmit="return false;">
                @csrf

                <div class="form-group mb-3">
                    <label>Kartu Keluarga</label>
                    <select name="kk_id" class="form-control select2bs4" required>
                        <option value="">- Pilih Kartu Keluarga -</option>
                        @foreach ($kartu_keluargas as $kk)
                            <option value="{{ $kk->id }}">
                                {{ $kk->no_kk }} - {{ $kk->nama_kepala_keluarga ?? 'null' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Upload Media Warga
                                    <small class="text-danger text-xs">
                                        <em>*Maksimal : 5MB | Jenis File : JPG, JPEG, PNG</em>
                                    </small>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div id="actions" class="row">
                                    <div class="col-lg-6">
                                        <div class="btn-group w-100">
                                            <span class="btn btn-success col fileinput-button">
                                                <i class="fas fa-plus"></i>
                                                <span>Files</span>
                                            </span>
                                            <button type="button" class="btn btn-primary col start">
                                                <i class="fas fa-upload"></i>
                                                <span>Proses Upload</span>
                                            </button>
                                            <button type="reset" class="btn btn-warning col cancel">
                                                <i class="fas fa-times-circle"></i>
                                                <span>Batalkan</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="fileupload-process w-100">
                                            <div id="total-progress" class="progress progress-striped active"
                                                role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;"
                                                    data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table table-striped files" id="previews">
                                    <div id="template" class="row mt-2">
                                        <div class="col-auto">
                                            <span class="preview">
                                                <img src="data:," alt="" data-dz-thumbnail />
                                            </span>
                                        </div>

                                        <div class="col">
                                            <p class="mb-1">
                                                <span class="lead" data-dz-name></span>
                                                (<span data-dz-size></span>)
                                            </p>

                                            <!-- TAMBAHAN -->
                                            <textarea class="form-control form-control-sm keterangan-file" placeholder="Keterangan file (opsional)" rows="2"></textarea>

                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                        </div>

                                        <div class="col-4 d-flex align-items-center">
                                            <div class="progress progress-striped active w-100">
                                                <div class="progress-bar progress-bar-success" style="width:0%;"
                                                    data-dz-uploadprogress></div>
                                            </div>
                                        </div>

                                        <div class="col-auto d-flex align-items-center">
                                            <div class="btn-group">
                                                <button class="btn btn-primary start">
                                                    <i class="fas fa-upload"></i>
                                                    <span>Start</span>
                                                </button>
                                                <button data-dz-remove class="btn btn-warning cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more
                                examples
                                and
                                information about the plugin.
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('js')
        <script>
            function getKkId() {
                const select = document.querySelector('select[name="kk_id"]');
                return select ? select.value : '';
            }

            function validateKk() {
                const KkId = getKkId();

                if (!KkId) {
                    alert('Silakan pilih KK terlebih dahulu sebelum upload.');
                    return false;
                }
                return true;
            }

            function hasFiles() {
                return myDropzone.getFilesWithStatus(Dropzone.ADDED).length > 0;
            }

            const selectKk = document.querySelector('select[name="kk_id"]');
            const startBtn = document.querySelector('#actions .start');

            selectKk.addEventListener('change', function() {
                startBtn.disabled = !this.value;
            });

            Dropzone.autoDiscover = false;

            const targetUrl = "{{ route('media_warga.store') }}";
            const KkId = "{{ $kk->id ?? '' }}"; // pastikan variabel ini ada

            // Ambil template
            let previewNode = document.querySelector("#template");
            previewNode.id = "";
            let previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);

            let myDropzone = new Dropzone(document.body, {
                url: targetUrl,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 10,
                previewTemplate: previewTemplate,
                autoQueue: false,
                previewsContainer: "#previews",
                clickable: ".fileinput-button",
                paramName: "file",
                maxFilesize: 5, // MB
                acceptedFiles: ".jpg,.jpeg,.png",
            });

            // tombol start per file
            myDropzone.on("addedfile", function(file) {
                file.previewElement.querySelector(".start").onclick = function() {
                    if (!validateKk()) {
                        return;
                    }

                    myDropzone.enqueueFile(file);
                };
            });

            // kirim data tambahan
            myDropzone.on("sending", function(file, xhr, formData) {
                const KkId = getKkId();

                let keterangan = file.previewElement
                    .querySelector(".keterangan-file")
                    .value;

                formData.append("kk_id", KkId);
                formData.append("keterangan", keterangan);
            });

            // progress bar
            myDropzone.on("totaluploadprogress", function(progress) {
                document.querySelector("#total-progress .progress-bar")
                    .style.width = progress + "%";
            });

            // selesai semua
            myDropzone.on("queuecomplete", function() {
                document.querySelector("#total-progress").style.opacity = "0";
                setTimeout(() => {
                    alert('Semua file telah diupload.');
                    window.location.href = "{{ route('media_warga.index') }}";
                }, 500);
            });

            // tombol global
            document.querySelector("#actions .start").onclick = function() {
                if (!validateKk()) {
                    return;
                }

                if (!hasFiles()) {
                    alert('Silakan tambahkan minimal 1 file sebelum upload.');
                    return;
                }

                myDropzone.enqueueFiles(
                    myDropzone.getFilesWithStatus(Dropzone.ADDED)
                );
            };

            document.querySelector("#actions .cancel").onclick = function() {
                myDropzone.removeAllFiles(true);
            };
        </script>
    @endpush
@endsection
