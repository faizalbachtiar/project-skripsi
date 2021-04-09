<div id="main">
    <div class="card col-md-10 shadow md-5 p-10 offset-md-1 bg-white rounded">
        <div class="card-body">
            <h2 class="mb-15 card-title">Pesan Produk</h2>
            <!-- Flash pemesanan produkfailed message -->
            <?php if ($this->session->flashdata('pemesanan_gagal')) : ?>
                <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('pemesanan_gagal') . '</p>'; ?>
            <?php endif; ?>
            <hr>
            <?php echo form_open('sales/pesan_produk'); ?>
            <div class="form-group">
                <label for="nm_produk">Nama Produk</label>
                <div class="mt-10">
                <div class="mt-10">
                                <select name="produk" id="produk" style="width: 100%; height:35px">
                                    <option value="">Nama</option>
                                    <?php foreach ($produk as $data) : ?>
                                        <option value='<?php echo $data->No_produk; ?>'>
                                            <?php echo $data->Nama; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <br />
                            </div>
                </div>
            </div>
            <div class="form-group">
                <label for="jumlah_produk">Jumlah</label>
                <div class="mt-10">
                    <input type="text" name="jumlah_produk" id="jumlah_produk"  class="single-input form-control"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </div>
            </div>
            <div class="form-group">
                <label for="tgl_pemasaran">Tanggal Pemasaran</label>
                <div class="mt-10">
                    <input type="date" name="tgl_pemasaran" id="tgl_pemasaran"  class="single-input form-control">
                </div>
            </div>
            <h6 class="card-title title_color mb-30  mt-10">Penambahan Pemesanan Produk
                        <button type="button" class="btn_tambah" id="button_tambah">+</button>
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dynamic_field" style="display : none" widht="300">
                                        <thead>
                                        <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Pemasaran</th>
                                        <th></th>
                                        </tr>
                                        </thead>
                                <tr>
                                    <td> <select style="width: 100%; height:35px" name="nama[]"  class="form-control name_list" >
                                    <option value="">Nama</option>
                                    <?php foreach ($produk as $data) : ?>
                                        <option value='<?php echo $data->No_produk; ?>'>
                                            <?php echo $data->Nama; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select></td>
                                    <td><input type="text" name="jumlah[]"  class="form-control harga_list" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/></td>  
                                    <td><input type="date" name="tanggal[]"  class="form-control tanggal_list"/></td>   
                                    <td><button type="button" name="add" id="add" class="btn btn-success">Tambah</button></td>  
                                </tr>
                            </table>
                        </div>
            <button class="btn btn-primary p-10" type="submit">Pesan</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#button_tambah').on('click',function(){
        var tabel=document.getElementById("dynamic_field");
        if(tabel.style.display=="none"){
            $("#dynamic_field").css("display","block");
        }else{
            $("#dynamic_field").css("display","none");
        }  
     });
    var i=1;
    $('#add').click(function(){
      i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="nama[]" class="form-control name_list"><option value="">Nama</option><?php foreach($produk as $data):?> <option value="<?php echo $data->No_produk; ?>"><?php echo $data->Nama; ?></option><?php endforeach; ?> </td><td><input type="text" name="jumlah[]"  class="form-control harga_list" onkeypress="return event.charCode >= 48 && event.charCode <= 57" /><td><input type="date" name="tanggal[]" class="form-control tanggal_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">hapus</button></td></tr>'); 
        }); 
    
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    });
    
});
</script>