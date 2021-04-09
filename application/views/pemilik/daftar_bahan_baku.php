<section class="section_gap">
    <div class="container">
            <div class="card col-md-12 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash pemilik edit Succes message -->
                <?php if($this->session->flashdata('succes_edit_bahan_baku')): ?>
                    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('succes_edit_bahan_baku').'</p>'; ?>
                      <?php endif; ?>
                <!-- Flash pemilik edit failed message -->
                <?php if($this->session->flashdata('failed_edit_bahan_baku')): ?>
                    <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('failed_edit_bahan_baku').'</p>'; ?>
                      <?php endif; ?>
                <h2 class="card-title title_color mb-30">Bahan Baku </h2>
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="pemilik_bahanbaku" name="pemilik_bahanbaku" type="text" placeholder="Bahan Baku mana Yang Anda Cari">
                    </div>
                    <div class="table-responsive">
                        <div id="resultbahanbaku"></div>
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
                    url: "<?php echo base_url(); ?>bahan_baku/search_bahan_baku",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#resultbahanbaku').html(data);
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