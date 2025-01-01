<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">CETAK LAPORAN</h6>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label text-white">MULAI TANGGAL</label>
                            <input type="date" name="tgl1" id="tgl1" class="form-control text-black bg-white" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label text-white">SAMPAI TANGGAL</label>
                            <input type="date" name="tgl2" id="tgl2" class="form-control text-black bg-white" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="padding-bottom: 25px;"></div>
                        <button class="btn btn-primary btn-lg" id="cari"><i class="fa fa-search"></i> CARI</button>
                        <button class="btn btn-success btn-lg"><i class="fa fa-print"></i> CETAK</button>
                    </div>
                </div>
                <hr>
                <div id="data-print" class="tampilkan_data">
                    <div class="loading"></div>
                </div>
            </div>


        </div>

    </div>
</div>

<script type="text/javascript">
    (function($) {
        $(document).ready(function(e) {
            $('#cari').on('click', function() {
                // $('#share').html('Loading...');
                // var cek = $('#cek').val();
                // var sup = $('#supp').val();
                var tgl1 = $('#tgl1').val();
                var tgl2 = $('#tgl2').val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('laporan/cari_data') ?>',
                    data: {
                        tgl1: tgl1,
                        tgl2: tgl2,
                    },
                    cache: false,
                    beforeSend: function() {
                        $('#search').html("SEARCHING...");
                        $(this).html("SEARCHING...").attr("disabled", "disabled");
                        $('.loading').html('Loading...');
                    },
                    success: function(data) {
                        $("#search").html("CARI").removeAttr("disabled");
                        $('.loading').html('');
                        $('.tampilkan_data').html(data);
                    }
                })
            })

            $('#print').on('click', function() {
                $('#hr').hide();
                $('#data-print').printArea();
            })
        })
    })(jQuery);
</script>