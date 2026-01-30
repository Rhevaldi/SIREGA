<?php $__env->startSection('title', 'Kartu Keluarga Baru'); ?>
<?php $__env->startSection('page-title', 'Kartu Keluarga Baru'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title mt-1">Form Kartu Keluarga Baru</h3>
                    <a href="<?php echo e(route('kk.index')); ?>" class="btn btn-sm btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> Daftar Kartu Keluarga
                    </a>
                </div>
                <!-- /.card-header -->
                <form action="<?php echo e(route('kk.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_kk">
                                        No. Kartu Keluarga <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input value="<?php echo e(old('no_kk')); ?>" type="text" id="no_kk" name="no_kk"
                                        class="form-control" placeholder="Masukkan No. KK" autofocus>
                                    <?php $__errorArgs = ['no_kk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_dikeluarkan">
                                        Tanggal Terbit KK <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input value="<?php echo e(old('tanggal_dikeluarkan')); ?>" type="date" id="tanggal_dikeluarkan"
                                        name="tanggal_dikeluarkan" class="form-control"
                                        placeholder="Masukkan Tanggal Terbit KK">
                                    <?php $__errorArgs = ['tanggal_dikeluarkan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="provinsi">
                                        Provinsi <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="provinsi" class="form-control select2bs4 w-100" required>
                                        <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($province['name']); ?>"
                                                <?php echo e($province['name'] == $default['province_name'] ? 'selected' : ''); ?>>
                                                <?php echo e($province['name']); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kabupaten">
                                        Kabupaten/Kota <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="kabupaten" class="form-control select2bs4 w-100" required>
                                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($city['name']); ?>"
                                                <?php echo e($city['name'] == $default['city_name'] ? 'selected' : ''); ?>>
                                                <?php echo e($city['name']); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['kabupaten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kecamatan">
                                        Kecamatan <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="kecamatan" class="form-control select2bs4" required>
                                        <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($district['name']); ?>"
                                                <?php echo e($district['name'] == $default['district_name'] ? 'selected' : ''); ?>>
                                                <?php echo e($district['name']); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="desa">
                                        Desa/Kelurahan <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="desa" class="form-control select2bs4" required>
                                        <?php $__currentLoopData = $villages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $village): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($village['name']); ?>"
                                                <?php echo e($village['name'] == $default['village_name'] ? 'selected' : ''); ?>>
                                                <?php echo e($village['name']); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['desa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="alamat">
                                        Alamat <span class="text-xs text-danger">*</span>
                                    </label>
                                    <textarea name="alamat" class="form-control" id="alamat" rows="2"
                                        placeholder="Masukkan Alamat Lengkap (Sesuai KK)"><?php echo e(old('alamat')); ?></textarea>
                                    <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rt">
                                        RT
                                    </label>
                                    <input value="12" type="number" id="rt" name="rt" class="form-control"
                                        placeholder="Masukkan RT (Contoh: 12)">
                                    <?php $__errorArgs = ['rt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rw">
                                        RW
                                    </label>
                                    <input value="<?php echo e(old('rw')); ?>" type="number" id="rw" name="rw"
                                        class="form-control" placeholder="Masukkan RW (Contoh: 12)">
                                    <?php $__errorArgs = ['rw'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kode_pos">
                                        Kode Pos
                                    </label>
                                    <input value="75571" type="number" id="kode_pos" name="kode_pos"
                                        class="form-control" placeholder="Masukkan Kode Pos">
                                    <?php $__errorArgs = ['kode_pos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="latitude">
                                        Latitude <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="text" id="latitude" name="latitude" class="form-control"
                                        value="<?php echo e(old('latitude', '-')); ?>">
                                    <?php $__errorArgs = ['latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="longitude">
                                        Longitude <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="text" id="longitude" name="longitude" class="form-control"
                                        value="<?php echo e(old('longitude', '-')); ?>">
                                    <?php $__errorArgs = ['longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-paper-plane"></i> Simpan
                        </button>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title mt-1">Mapping Data</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-2">
                                <label>
                                    Tandai Lokasi Rumah
                                    <button type="button" class="btn btn-info btn-xs ml-2" onclick="getLocation()">
                                        <i class="fas fa-location-arrow"></i> Gunakan Lokasi Saat Ini
                                    </button>
                                </label>
                                <div id="mapForm" style="height:300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('js'); ?>
        <script>
            // 1. Ambil nilai dari Laravel, beri fallback string kosong jika null
            let latRaw = "<?php echo e(old('latitude')); ?>";
            let lngRaw = "<?php echo e(old('longitude')); ?>";

            let latForm = parseFloat(latRaw);
            let lngForm = parseFloat(lngRaw);

            // 2. Tentukan koordinat awal (Default: Jakarta atau tengah Indonesia) 
            // agar map tidak error saat inisialisasi awal
            let defaultLat = -6.200000;
            let defaultLng = 106.816666;

            // 3. Cek apakah koordinat valid (tidak NaN)
            const hasCoords = !isNaN(latForm) && !isNaN(lngForm);

            // Inisialisasi map dengan koordinat yang ada atau default
            const mapForm = L.map('mapForm').setView([hasCoords ? latForm : defaultLat, hasCoords ? lngForm : defaultLng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(mapForm);

            // Inisialisasi marker
            let markerForm = L.marker([hasCoords ? latForm : defaultLat, hasCoords ? lngForm : defaultLng], {
                draggable: true
            }).addTo(mapForm);

            function updateLatLng(latForm, lngForm) {
                document.getElementById('latitude').value = latForm.toFixed(8);
                document.getElementById('longitude').value = lngForm.toFixed(8);
                markerForm.setLatLng([latForm, lngForm]);
                mapForm.setView([latForm, lngForm], 16);
            }

            mapForm.on('click', e => updateLatLng(e.latlng.latForm, e.latlng.lngForm));
            markerForm.on('dragend', e => updateLatLng(e.target.getLatLng().latForm, e.target.getLatLng().lngForm));

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        pos => updateLatLng(pos.coords.latitude, pos.coords.longitude),
                        () => {
                            alert('Gagal mengambil lokasi. Pastikan GPS aktif dan izin lokasi diberikan.');
                        }
                    );
                } else {
                    alert("Browser Anda tidak mendukung Geolocation.");
                }
            }

            // 4. LOGIKA UTAMA: Jika lat/lng kosong, jalankan getLocation()
            if (!hasCoords) {
                getLocation();
            } else {
                updateLatLng(latForm, lngForm);
            }
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/kk/create.blade.php ENDPATH**/ ?>