<section class="section_gap">
    <div class="container">
            <div class="card col-md-20 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash terima permintaan produk berhasil message -->
                <?php if($this->session->flashdata('konfirmasi_pembayaran')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('konfirmasi_pembayaran').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash kekurangan setoran berhasil message -->
                <?php if($this->session->flashdata('proses_input_kekurangan_succes')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('proses_input_kekurangan_succes').'</p>'; ?>
                        <?php endif; ?>
                 <!-- Flash kekurangan setoran failed message -->
                <?php if($this->session->flashdata('proses_input_kekurangan_failed')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('proses_input_kekurangan_failed').'</p>'; ?>
                        <?php endif; ?>
                <h2 class="card-title title_color mb-30">Riwayat pemesanan sales</h2>
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="pemesanan" name="pemesanan" type="text" placeholder="Riwayat Pemesanan sales mana Yang Anda Cari">
                    </div>
                    <div class="table-responsive">
                        <div id="result_pemesanan_sales"></div>
                    </div>
                </div>
            </div>
        </div>
</section> 

<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            pemesanan();

            function pemesanan(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>riwayat_pemesanan/riwayat",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#result_pemesanan_sales').html(data);
                    }
                });
            }

            $('#pemesanan').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    pemesanan(search);
                } else {
                    pemesanan();
                }
            });
        });
    </script>