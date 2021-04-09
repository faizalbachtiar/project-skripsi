<section class="section_gap">
        <div class="container">
            <div class="card col-md-12 mb-30 mt-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                    <h2 class="card-title title_color mb-30">Daftar Sales</h2>
                    <p class="card-subtitle text-muted">
                        Pada bagian ini berisikan sales yang telah terdaftar
                    </p>
                </div>
            </div>
            <div class="card col-md-12 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="searchsales" name="searchsales" type="text" placeholder="Sales mana Yang Anda Cari">
                    </div>

                    <div class="table-responsive">
                        <div id="resultsales"></div>
                    </div>
                </div>
            </div>
</section> 
<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            searchsales();

            function searchsales(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>sales/searchsales",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#resultsales').html(data);
                    }
                });
            }

            $('#searchsales').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    searchsales(search);
                } else {
                    searchsales();
                }
            });
        });
    </script>