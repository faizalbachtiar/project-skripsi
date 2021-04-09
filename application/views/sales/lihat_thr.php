<div id="main">
            <div class="card col-md-20 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                <h2 class="card-title title_color mb-30">Tunjangan Hari Raya</h2>
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="tunjangan" name="tunjangan" type="text" placeholder="Tunjangan Hari Raya mana Yang Anda Cari">
                    </div>
                    <div class="table-responsive">
                        <div id="result_tunjangan"></div>
                    </div>
                </div>
            </div>
        </div>
<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            tunjangan();

            function tunjangan(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>tunjangan_thr/thr_sales",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#result_tunjangan').html(data);
                    }
                });
            }

            $('#tunjangan').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    tunjangan(search);
                } else {
                    tunjangan();
                }
            });
        });
    </script>