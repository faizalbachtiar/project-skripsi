<section class="section_gap">
    <div class="container">
            <div class="card col-md-12 mb-30 mt-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                    <h2 class="card-title title_color mb-30">Daftar Produk</h2>
                    <p class="card-subtitle text-muted">
                        Pada bagian ini berisikan produk yang ada pada UKM krupuk jaya
                    </p>
                </div>
            </div>
            <div class="card col-md-12 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="searchproduk" name="searchproduk" type="text" placeholder="Produk mana Yang Anda Cari">
                    </div>

                    <div class="table-responsive">
                        <div id="resultproduk"></div>
                    </div>
                </div>
            </div>
</section> 
<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            searchproduk();

            function searchproduk(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>produk/searchproduk",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#resultproduk').html(data);
                    }
                });
            }

            $('#searchproduk').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    searchproduk(search);
                } else {
                    searchproduk();
                }
            });
        });
    </script>