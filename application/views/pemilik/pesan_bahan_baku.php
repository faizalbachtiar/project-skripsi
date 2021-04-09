<section class="section_gap">
    <div class="container">
            <div class="card col-md-8 offset-md-2 mb-20 mt-25 shadow p-3 bg-white rounded">
                <div class="card-body">
                 <!-- Flash pemilik pesan bahan baku failed message -->
                 <?php if($this->session->flashdata('failed_pesan_bahan_baku')): ?>
                    <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('failed_pesan_bahan_baku').'</p>'; ?>
                        <?php endif; ?>
                <h2 class="card-title title_color mb-30">Data Pemesanan</h2>
                <form method="post" id="insert_data">
                        <h5 class="card-title title_color mb-35">Nama Supplier</h5> 
                        <div class="form-group">
                            <div class="mt-10">
                                <select name="No_ktp_supplier" id="No_ktp_supplier" style="width: 100%; height:35px">
                                    <option value="">Nama Supplier</option>
                                    <?php foreach ($supplier as $data) : ?>
                                        <option value='<?php echo $data->No_ktp; ?>'>
                                            <?php echo $data->Nama; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <br />
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="card-title title_color mb-35">Nama Bahan Baku</h5>
                            <div class="mt-10">
                                <select name="nama_bahan_baku" id="nama_bahan_baku" style="width: 100%; height:35px">
                                    <option value="">Bahan Baku</option>
                                </select>
                                <br />
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="card-title title_color mb-35">Berat (Kg)</h5> 
                            <div class="mt-10">
                                <input type="text" name="berat" id="berat" onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="card-title title_color mb-35">Harga Total</h5>
                            <div class="mt-10">
                                <input type="text" name="harga" id="harga" class="form-control action">
                            </div>
                        </div>
                        <input type="hidden" name="no_bahan_baku" id="no_bahan_baku" />
                        <input type="submit" name="simpan" id="action"  class="btn primary-btn btn-block" value="Pesan" />
                    </form>

            </div>
        </div>
</section> 
<script type="text/javascript">
function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }

    $('#No_ktp_supplier').change(function() {
            if ($(this).val() != '') {
                var action = $(this).attr("id");
                var no_ktp_supplier = $(this).val();
                var result = '';

                if (action == 'No_ktp_supplier') {
                    result = 'nama_bahan_baku';
                }
                $.ajax({
                    url: "<?php echo base_url(); ?>supplier/ambil_bahan_baku",
                    method: "POST",
                    data: {
                        no_ktp_supplier: no_ktp_supplier
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                        if (result == 'nama_bahan_baku') {
                            var No_bahan_baku = $('#nama_bahan_baku').val();
                            $('#nama_bahan_baku').change(function() {
                            var No_bahan_baku = $('#nama_bahan_baku').val();
                            });
                        }
                    }
                })
                
            }
        });
        $('#berat').keyup(function(){
            var bahan_baku = $('#nama_bahan_baku').val();
            var data = bahan_baku.split("/");
            var harga = data[1];
            var no = data[0];
            $("#no_bahan_baku").val(no);
            var berat = $('#berat').val();
            var harga_total=berat*harga;
            $("#harga").val("Rp. "+harga_total);
        });
        $('#insert_data').on('submit', function(event) {
            event.preventDefault();
            if ($('#No_ktp_supplier').val() == '') {
                alert("Pastikan sudah mengisi semua data yang diperlukan");
                return false;
            } else if ($('#nama_bahan_baku').val()==''){
                alert("Pastikan sudah mengisi semua data yang diperlukan");
                return false;
            } else if ($('#berat').val()=='' || $('#harga').val()==''){
                alert("Pastikan sudah mengisi semua data yang diperlukan");
                return false;
            }else {
                var form_data = $(this).serialize();
                $.ajax({
                    //untuk insert data
                    url: 'bahan_baku/pesan_bahan_baku',
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        console.log("proses");
                        window.location='pemilik_daftar_p_bahan_baku';
                    }
                });
            }
           
        });
</script>
    