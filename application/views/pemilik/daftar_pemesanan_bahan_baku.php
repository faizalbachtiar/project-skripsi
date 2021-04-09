<section class="section_gap">
    <div class="container">
            <div class="card col-md-20 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash pemilik pesan bahan baku berhasil message -->
                <?php if($this->session->flashdata('succes_pesan_bahan_baku')): ?>
                    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('succes_pesan_bahan_baku').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash pemilik konfirmasi bahan baku berhasil message -->
                <?php if($this->session->flashdata('konfirmasi_succes')): ?>
                    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('konfirmasi_succes').'</p>'; ?>
                        <?php endif; ?>
                <h2 class="card-title title_color mb-30">Daftar Pemesanan Bahan Baku </h2>
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="pemilik_bahanbaku" name="pemilik_bahanbaku" type="text" placeholder="Pemesanan Bahan Baku mana Yang Anda Cari">
                    </div>
                    <div class="table-responsive">
                        <div id="resultpemesananbahanbaku"></div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            pemilik_bahanbaku();

            function pemilik_bahanbaku(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>bahan_baku/search_pemesanan_bahan_baku",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#resultpemesananbahanbaku').html(data);
                    }
                });
            }

            $('#pemilik_bahanbaku').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    pemilik_bahanbaku(search);
                } else {
                    pemilik_bahanbaku();
                }
            });
        });
    </script>