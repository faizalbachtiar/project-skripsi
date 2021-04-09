<div id="main">
            <div class="card col-md-20 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash pemesanan produk berhasil message -->
                <?php if($this->session->flashdata('pemesanan_berhasil')): ?>
                    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('pemesanan_berhasil').'</p>'; ?>
                        <?php endif; ?>
                <h2 class="card-title title_color mb-30">Riwayat Pemesanan</h2>
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="riwayat_pemesanan" name="riwayat_pemesanan" type="text" placeholder="Riwayat Pemesanan mana Yang Anda Cari">
                    </div>
                    <div class="table-responsive">
                        <div id="result_riwayat_pemesanan"></div>
                    </div>
                </div>
            </div>
        </div>
<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            riwayat_pemesanan();

            function riwayat_pemesanan(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>riwayat_pemesanan_sales/search",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#result_riwayat_pemesanan').html(data);
                    }
                });
            }

            $('#riwayat_pemesanan').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    riwayat_pemesanan(search);
                } else {
                    riwayat_pemesanan();
                }
            });
        });
    </script>