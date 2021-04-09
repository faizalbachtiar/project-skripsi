<div id="main">
            <div class="card col-md-20 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash penolakan permintaan bahan baku Succes message -->
                <?php if($this->session->flashdata('penolakan_berhasil')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('penolakan_berhasil').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash penolakan permintaan bahan baku failed message -->
                <?php if($this->session->flashdata('penolakan_gagal')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('penolakan_gagal').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash setujui permintaan bahan baku Succes message -->
                <?php if($this->session->flashdata('setujui_berhasil')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('setujui_berhasil').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash setujui permintaan bahan baku failed message -->
                <?php if($this->session->flashdata('setujui_gagal')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('setujui_gagal').'</p>'; ?>
                        <?php endif; ?>           
                <h2 class="card-title title_color mb-30">Data Permintaan Bahan Baku</h2>
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="permintaan_b_baku" name="permintaan_b_baku" type="text" placeholder="Permintaan Bahan Baku mana Yang Anda Cari">
                    </div>
                    <div class="table-responsive">
                        <div id="result_permintaan_b_baku"></div>
                    </div>
                </div>
            </div>
        </div>
<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            permintaan_b_baku();

            function permintaan_b_baku(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>permintaan_bahan_baku/permintaan",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#result_permintaan_b_baku').html(data);
                    }
                });
            }

            $('#permintaan_b_baku').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    permintaan_b_baku(search);
                } else {
                    permintaan_b_baku();
                }
            });
        });
    </script>