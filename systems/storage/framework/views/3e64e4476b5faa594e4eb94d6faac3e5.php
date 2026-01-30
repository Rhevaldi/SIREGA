<?php $__env->startSection('title', 'Media Warga'); ?>
<?php $__env->startSection('page-title', 'Data Media Warga'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">

        <div class="card-header">
            <a href="<?php echo e(route('media_warga.create')); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Upload File
            </a>
        </div>


        <div class="card-body table-responsive">
            <?php if(session('success')): ?>
                <div class="alert alert-success mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            
            <table class="table table-bordered table-striped defaultDataTable" style="width: 100% !important;">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>No. Kartu Keluarga</th>
                        <th>Kepala Keluarga</th>
                        <th class="text-center">Jumlah Dokumen</th>
                        <th style="width: 500px;">Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $kartuKeluargas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($loop->iteration); ?>

                            </td>
                            <td>
                                <?php echo e($kk->no_kk ?? '-'); ?>

                            </td>
                            <td class="text-nowrap">
                                <?php echo e($kk->nama_kepala_keluarga ?? 'null'); ?>

                            </td>
                            <td class="text-center">
                                <?php echo e($kk->media_warga->count()); ?>

                            </td>
                            <td>
                                <div uk-lightbox="slidenav: false; nav: thumbnav">
                                    <ul class="list-inline mb-0">
                                        <?php $__currentLoopData = $kk->media_warga->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-inline-item">
                                                <a href="/storage/<?php echo e($item->file_path); ?>"
                                                    data-caption="<?php echo e($item->keterangan); ?>">
                                                    <img alt="Avatar" class="table-avatar img-fixed img-thumbnail"
                                                        style="width: 2.3rem !important; height: 2.3rem !important; border-radius: 50%;"
                                                        src="/storage/<?php echo e($item->file_path); ?>">
                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </td>
                            
                            
                            <td class="text-nowrap">
                                <div class="btn-group" role="group">
                                    <button type="button" id="showMedia" data-id="<?php echo e($kk->id); ?>"
                                        class="btn btn-info btn-sm btn-flat">
                                        <i class="fas fa-eye"></i> Detail Media
                                    </button>
                                </div>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
        </div>
    </div>

    <!-- Media Modal -->
    <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby
        ="mediaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediaModalLabel">Detail Media Warga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Media content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('js'); ?>
        <script>
            $(document).ready(function() {
                // show media on modal
                $(document).on('click', '#showMedia', function() {
                    var mediaId = $(this).data('id');
                    $.ajax({
                        url: '/media_warga/' + mediaId,
                        type: 'GET',
                        success: function(response) {
                            var mediaList = response.media_warga;
                            var modalBody = '';
                            if (mediaList.length > 0) {
                                modalBody +=
                                    '<div class="row" uk-lightbox="slidenav: false; nav: thumbnav">';
                                mediaList.forEach(function(media) {
                                    if (['jpg', 'jpeg', 'png'].includes(media.file_type)) {
                                        modalBody +=
                                            '<div class="col-md-4 text-center mb-3">';
                                        modalBody += '<a href="/storage/' + media
                                            .file_path + '" data-caption="' + (media
                                                .keterangan ?? '') + '">';
                                        modalBody += '<img src="/storage/' + media
                                            .file_path +
                                            '" width="200" class="img-fixed mb-1" onerror="this.style.display=\'none\'"><br>';
                                        modalBody += '</a>';
                                        modalBody += '<p class="mb-0">' + (media
                                            .keterangan ?? '-') + '</p>';
                                    } else {
                                        modalBody += '<div class="mb-3">';
                                        modalBody += '<a href="/storage/' + media
                                            .file_path + '" target="_blank">' + media
                                            .file_name + '</a>';
                                    }

                                    // 🔥 TOMBOL HAPUS PER FILE
                                    modalBody += `
        <form method="POST" action="/media_warga/${media.id}" 
            onsubmit="return confirm('Yakin ingin menghapus file ini?')" class="mt-2">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </form>
    `;

                                    modalBody += '</div>';
                                });

                                modalBody += '</div>';
                            } else {
                                modalBody = '<p>Tidak ada media tersedia.</p>';
                            }
                            $('#mediaModal .modal-body').html(modalBody);
                            $('#mediaModal').modal('show');
                        }
                    });
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/media_warga/index.blade.php ENDPATH**/ ?>