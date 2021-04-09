<section class="section_gap">
    <div class="container">
            <div class="card col-md-12 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash buat tunjangan berhasil message -->
                <?php if($this->session->flashdata('create_tunjangan_succes')): ?>
                    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('create_tunjangan_succes').'</p>'; ?>
                       <?php endif; ?>
                <!-- Flash buat tunjangan gagal message -->
                <?php if($this->session->flashdata('create_tunjangan_failed')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('create_tunjangan_failed').'</p>'; ?>
                        <?php endif; ?>
                <h2 class="card-title title_color mb-30">Daftar Tunjangan Hari Raya </h2>
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="tunjangan_hr" name="tunjangan_hr" type="text" placeholder="Tunjangan Hari raya mana Yang Anda Cari">
                    </div>
                    <div class="table-responsive">
                        <div id="result_thr"></div>
                    </div>
                </div>
            </div>
        </div>
</section> 
<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            tunjangan_hr();

            function tunjangan_hr(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>tunjangan_thr/search_thr",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#result_thr').html(data);
                    }
                });
            }

            $('#tunjangan_hr').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    tunjangan_hr(search);
                } else {
                    tunjangan_hr();
                }
            });
        });
    </script>