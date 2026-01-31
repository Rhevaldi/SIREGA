<div class="modal fade" id="modalDetailWarga" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Warga</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    {{-- Informasi Detail Warga --}}
                    <div class="col-12">
                        <h6>
                            <strong>Informasi Detail Warga</strong>
                        </h6>
                        <div class="row">
                            <div class="col-6">
                                <table class="table table-sm table-borderless table-striped">
                                    <tr>
                                        <th width="200">No. KK</th>
                                        <td>
                                            : <span id="detailWargaNoKK"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="200">NIK</th>
                                        <td>
                                            : <span id="detailWargaNIK"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>
                                            : <span id="detailWargaNama"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>
                                            : <span id="detailWargaJenisKelamin" class="text-uppercase"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td>
                                            : <span id="detailWargaTempatLahir" class="text-uppercase"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>
                                            : <span id="detailWargaTanggalLahir"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td>
                                            : <span id="detailWargaAgama" class="text-uppercase"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-sm table-borderless table-striped">
                                    <tr>
                                        <th>Pendidikan</th>
                                        <td>
                                            : <span id="detailWargaPendidikan" class="text-uppercase"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>
                                            : <span id="detailWargaPekerjaan" class="text-uppercase"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status Dalam Keluarga</th>
                                        <td>
                                            : <span id="detailWargaStatusHubungan" class="text-uppercase"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status Perkawinan</th>
                                        <td>
                                            : <span id="detailWargaStatusPerkawinan" class="text-uppercase"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status Warga</th>
                                        <td>
                                            : <span id="detailWargaStatusWarga" class="text-uppercase"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>
                                            : <span id="detailWargaAlamat"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>RT/RW</th>
                                        <td>
                                            : <span id="detailWargaRTRW"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <h6>
                            <strong>Indikator Kesejahteraan Masyarakat</strong>
                        </h6>
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th> Status</th>
                                </tr>
                            </thead>
                            <tbody id="detailWargaIndikatorBody">
                            </tbody>
                        </table>
                    </div>

                    <div class="col-6">
                        <h6>
                            <strong>Penerima Bansos</strong>
                            <a href="javascript:;" class="text-xs float-right text-primary btnAddBansos">
                                <i class="fas fa-plus"></i> Tambah Bansos
                            </a>
                        </h6>
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Jenis Bansos</th>
                                    <th>Tahun</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="detailWargaPenerimaBansosBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bansosModal" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <form action="{{ route('bansos-penerima.store') }}" method="POST">

            @csrf
            <input type="hidden" name="warga_id" id="warga_id" value="">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penerima Bansos</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Program Bansos</label>
                        <select name="bansos_id" id="bansos_id" class="form-control" required>
                            <option value="">-- Pilih Program --</option>
                            @foreach ($bansosList as $b)
                                <option value="{{ $b->id }}">
                                    {{ $b->nama_program }} ({{ $b->tahun }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Penerimaan</label>
                        <input type="date" name="tanggal_penerimaan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="calon penerima">Calon Penerima</option>
                            <option value="penerima">Penerima</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>

                </div>


                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
