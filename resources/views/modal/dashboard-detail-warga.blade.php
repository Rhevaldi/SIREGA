<div class="modal fade" id="modalDetailWarga" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Warga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    {{-- Informasi Detail Warga --}}
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between mb-2">
                            <h6><strong>Informasi Detail Warga</strong></h6>
                        </div>
                        <table class="table table-sm table-borderless table-striped">
                            <tr>
                                <th width="200">No. KK</th>
                                <td>:</td>
                                <td id="md-no_kk">-</td>
                            </tr>
                            <tr>
                                <th width="200">NIK</th>
                                <td>:</td>
                                <td id="md-nik">-</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td id="md-nama">-</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>:</td>
                                <td id="md-jenis_kelamin" class="text-uppercase">-</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>:</td>
                                <td id="md-tempat_lahir" class="text-uppercase">-</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>:</td>
                                <td id="md-tanggal_lahir">-</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>:</td>
                                <td id="md-agama" class="text-uppercase">-</td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <td>:</td>
                                <td id="md-pendidikan" class="text-uppercase">-</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>:</td>
                                <td id="md-pekerjaan" class="text-uppercase">-</td>
                            </tr>
                            <tr>
                                <th>Status Dalam Keluarga</th>
                                <td>:</td>
                                <td id="md-status_hubungan" class="text-uppercase">-</td>
                            </tr>
                            <tr>
                                <th>Status Perkawinan</th>
                                <td>:</td>
                                <td id="md-status_perkawinan" class="text-uppercase">-</td>
                            </tr>
                            <tr>
                                <th>Status Warga</th>
                                <td>:</td>
                                <td id="md-status_warga" class="text-uppercase">-</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td id="md-alamat">-</td>
                            </tr>
                            <tr>
                                <th>RT</th>
                                <td>:</td>
                                <td id="md-rt">-</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between mb-2">
                            <h6><strong>Bantuan Sosial</strong></h6>
                        </div>
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Jenis Bansos</th>
                                    <th width="80">Tahun</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="md-bansos">
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        - Tidak Menerima Bantuan Sosial -
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between mb-2">
                            <h6><strong>Media Warga</strong></h6>
                        </div>
                        <div class="row" id="md-medias">
                            <div class="col-12 text-center text-muted">
                                - Tidak ada media -
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                {{-- <h6>Bantuan Sosial</h6>
                <div id="md-bansos">
                    <em class="text-muted">Tidak menerima bansos</em>
                </div> --}}
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
