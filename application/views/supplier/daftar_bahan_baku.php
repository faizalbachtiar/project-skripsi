<div id="main">
            <div class="card col-md-20 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash hapus bahan baku Succes message -->
                <?php if($this->session->flashdata('hapus_b_baku')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('hapus_b_baku').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash edit bahan baku Succes message -->
                <?php if($this->session->flashdata('succes_edit_bahan_baku')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('succes_edit_bahan_baku').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash edit bahan baku failed message -->
                <?php if($this->session->flashdata('succes_failed_bahan_baku')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('succes_failed_bahan_baku').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash buat bahan baku Succes message -->
                <?php if($this->session->flashdata('buat_b_baku_succes')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('buat_b_baku_succes').'</p>'; ?>
                        <?php endif; ?>
                <h2 class="card-title title_color mb-30">Daftar Bahan Baku</h2>
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="b_baku" name="b_baku" type="text" placeholder="Daftar Bahan Baku mana Yang Anda Cari">
                    </div>
                    <div class="table-responsive">
                        <div id="result_b_baku"></div>
                    </div>
                </div>
            </div>
        </div>
<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            b_baku();

            function b_baku(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>bahan_baku_supplier/daftar_b_baku",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#result_b_baku').html(data);
                    }
                });
            }

            $('#b_baku').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    b_baku(search);
                } else {
                    b_baku();
                }
            });
        });
    </script>