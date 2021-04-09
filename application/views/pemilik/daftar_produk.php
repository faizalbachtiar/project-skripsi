<section class="section_gap">
    <div class="container">
            <div class="card col-md-12 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash buat produk berhasil message -->
                <?php if($this->session->flashdata('create_produk_berhasil')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('create_produk_berhasil').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash hapus produk berhasil message -->
                <?php if($this->session->flashdata('hapus_produk_berhasil')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('hapus_produk_berhasil').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash edit produk berhasil message -->
                <?php if($this->session->flashdata('edit_produk_berhasil')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('edit_produk_berhasil').'</p>'; ?>
                        <?php endif; ?>
                <!-- Flash edit produk gagal message -->
                <?php if($this->session->flashdata('edit_produk_gagal')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('edit_produk_gagal').'</p>'; ?>
                        <?php endif; ?>
                <h2 class="card-title title_color mb-30">Daftar Produk</h2>
                    <div class="search-area form-group">
                        <input class="col-md-6 form-control" id="pemilik_searchproduk" name="pemilik_searchproduk" type="text" placeholder="Produk mana Yang Anda Cari">
                    </div>
                    <div class="table-responsive">
                        <div>
                        <table class="table" id="resultproduk">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Keterangan</th>
                            <th>Harga per satuan</th>
                            <th>Potongan BBM</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($produk):?>
                            <?php foreach($produk as $data):?>
                           
                           <tr>
                               <td ng-repeat="col in columns" class="ng-scope">
                                   <div ng-switch="" on="col.renderType">
                                       <div ng-switch-when="primaryLink" class="ng-scope">
                                           <p><?php echo $data->Nama?></p>
                                       </div>
                                   </div>
                               </td>
                               <td ng-repeat="col in columns" class="ng-scope">
                                   <div ng-switch="" on="col.renderType">
                                       <div ng-switch-when="primaryLink" class="ng-scope">
                                       <img src="assets/img/produk/<?php echo $data->gambar ?>"width="150" height="150">
                                       </div>
                                   </div>
                               </td>
                               <td ng-repeat="col in columns" class="ng-scope">
                                   <div ng-switch="" on="col.renderType">
                                       <div ng-switch-when="primaryLink" class="ng-scope">
                                       <p><?php echo $data->keterangan?></p>
                                       </div>
                                   </div>
                               </td>
                               <td ng-repeat="col in columns" class="ng-scope">
                                   <div ng-switch="" on="col.renderType">
                                       <div ng-switch-when="primaryLink" class="ng-scope">
                                       <p><?php echo $data->Harga_satuan?></p>
                                       </div>
                                   </div>
                               </td>
                               <td ng-repeat="col in columns" class="ng-scope">
                                   <div ng-switch="" on="col.renderType">
                                       <div ng-switch-when="primaryLink" class="ng-scope">
                                       <p><?php echo $data->potongan_bbm?></p>
                                        </div>
                                   </div>
                               </td>
                               <td ng-repeat="col in columns" class="ng-scope">
                               <div ng-switch="" on="col.renderType">
                                   <div ng-switch-when="primaryLink" class="ng-scope">
                                   <button type="button" class="btn btn-info">Edit</button>
                                  </div>
                               </div>
                               </td>
                               <td ng-repeat="col in columns" class="ng-scope">
                               <div ng-switch="" on="col.renderType">
                                   <div ng-switch-when="primaryLink" class="ng-scope">
                                        <a href="produk/hapus/<?php echo $data->No_produk ?>" class="btn btn-info">
                                           Hapus
                                       </a>
                                   </div>
                               </div>
                               </td>
                           </tr>
                           <?php endforeach; ?>
                        <?php endif;?>
                        <?php if(!$produk):?>
                            <tr>
                                <td ng-repeat="col in columns" class="ng-scope" colspan="6">
                                    <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                    <br>
                                    <p class="text-center text-danger">Data tidak ditemukan</p>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endif;?>
                        </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>  
<!-- live search script -->
<script type="text/javascript">
        $(document).ready(function() {
            pemilik_searchproduk();

            function pemilik_searchproduk(query) {
                $.ajax({
                    url: "<?php echo base_url(); ?>produk/pemilik_searchproduk",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#resultproduk').html(data);
                    }
                });
            }

            $('#pemilik_searchproduk').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    pemilik_searchproduk(search);
                } else {
                    pemilik_searchproduk();
                }
            });
        });
    </script>