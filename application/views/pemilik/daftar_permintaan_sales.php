<section class="section_gap">
        <div class="container">
            <div class="card col-md-12 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash terima permintaan produk berhasil message -->
                <?php if($this->session->flashdata('permintaan_produk_diterima')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('permintaan_produk_diterima').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash terima permintaan produk gagal message -->
                <?php if($this->session->flashdata('permintaan_produk_ditolak')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('permintaan_produk_ditolak').'</p>'; ?>
                        <?php endif; ?>
                <h2>Daftar permintaan sales</h2>
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="searchrequest" name="searchrequest" type="text" placeholder="Permintaan Sales mana Yang Anda Cari">
                    </div>

                    <div class="table-responsive">
                        <div id="resultrequest"></div>
                    </div>
                </div>
            </div>
</section> 
<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            searchrequest();

            function searchrequest(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>pemesanan_produk/searchrequest",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#resultrequest').html(data);
                    }
                });
            }

            $('#searchrequest').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    searchrequest(search);
                } else {
                    searchrequest();
                }
            });
        });
    </script>