{{-- ================= MODAL DETAIL KELUARGA  ================= --}}
<div class="modal fade" id="modalDetailKK" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" {{-- style="max-width: fit-content;" --}}>
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Data Anggota Keluarga</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row justify-content-between">
                    <div class="col-12 text-center">
                        <h1 class="font-weight-bold mb-0">KARTU KELUARGA</h1>
                        <h2 class="font-weight-bold">No. <span id="showNoKk">-</span></h2>
                    </div>
                    <div class="col-md-4">
                        <table class="w-100 text-sm">
                            <tr class="font-weight-bold">
                                <td>Nama Kepala Keluarga</td>
                                <td>:</td>
                                <td id="showNamaKepalaKeluarga">-</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td id="showAlamat">-</td>
                            </tr>
                            <tr>
                                <td>RT/RW</td>
                                <td>:</td>
                                <td>
                                    <span id="showRt">-</span> / <span id="showRw">-</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Desa/Kelurahan</td>
                                <td>:</td>
                                <td id="showDesaKelurahan">-</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="w-100 text-sm">
                            <tr>
                                <td>Kecamatan</td>
                                <td>:</td>
                                <td id="showKecamatan">-</td>
                            </tr>
                            <tr>
                                <td>Kabupaten/Kota</td>
                                <td>:</td>
                                <td id="showKabupatenKota">-</td>
                            </tr>
                            <tr>
                                <td>Kode Pos</td>
                                <td>:</td>
                                <td id="showKodePos">-</td>
                            </tr>
                            <tr>
                                <td>Provinsi</td>
                                <td>:</td>
                                <td id="showProvinsi">-</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-sm text-nowrap">
                        <thead class="table-secondary">
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Agama</th>
                                <th>Pendidikan</th>
                                <th>Jenis Pekerjaan</th>
                            </tr>
                        </thead>
                        <tbody id="keluargaBody">

                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <!-- Media -->
                    <div class="col-md-6">
                        <h5 class="mb-2">Media Keluarga</h5>
                        <div id="mediaContainer">
                            <div class="col-12 text-muted text-center">
                                Tidak ada media
                            </div>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="col-md-6">
                        <h5 class="mb-2">Koordinat Rumah</h5>
                        <div id="map" style="height:300px;border:1px solid #ddd"></div>
                        <small class="text-muted d-block mt-1">
                            Latitude: <span id="showLat" class="font-weight-bold">-</span>,
                            Longitude: <span id="showLng" class="font-weight-bold">-</span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
