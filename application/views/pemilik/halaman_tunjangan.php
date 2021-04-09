<section class="section_gap">
    <div class="container">
            <div class="card col-md-8 offset-md-2 mb-20 mt-25 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash pemilik buat thr succes message -->
                <?php if($this->session->flashdata('create_tunjangan_succes')): ?>
                    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('create_tunjangan_succes').'</p>'; ?>
                      <?php endif; ?>
                      <!-- Flash pemilik buat thr  gagal message -->
                 <?php if($this->session->flashdata('create_tunjangan_failed')): ?>
                    <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('create_tunjangan_failed').'</p>'; ?>
                      <?php endif; ?>
                    <h4 class="title_color">Tunjangan Hari Raya</h4>
                    <form method="post" id="insert_data">
                        <div class="form-group">
                            <label for="nama_sales">Nama sales</label>
                            <div class="mt-10">
                                <select name="No_ktp_sales" id="No_ktp_sales" style="width: 100%; height:35px">
                                    <option value="">Nama</option>
                                    <?php foreach ($sales as $data) : ?>
                                        <option value='<?php echo $data->No_ktp; ?>'>
                                            <?php echo $data->Nama; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <br />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tgl">Tanggal</label>
                            <div class="mt-10">
                                <input type="date" name="tgl" id="tgl"  class="form-control action">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <div class="mt-10">
                                <input type="text" name="nilai" id="nilai"  class="form-control action" onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <div class="mt-10">
                                <input type="text" name="keterangan" id="keterangan" class="form-control action">
                            </div>
                        </div>
                        <input type="submit" name="simpan" id="action"  class="btn primary-btn btn-block" value="Buat Tunjangan" />
                    </form>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
</section>
<script type="text/javascript">
   $(document).ready(function() {
         //proses insert function 
         $('#insert_data').on('submit', function(event) {
            event.preventDefault();
            /*if ($('#No_ktp_sales').val() == '' || $('#No_ktp_sales').val() == 'Nama') {
                alert("Silahkan Pilih Sales");
                return false;
            } else if ($('#tgl').val() == ''){
                alert("Silahkan memasukkan tanggal");
                return false;
            } else if ($('#nilai').val() == ''){
                alert("Silahkan memasukkan nilai");
                return false;
            }else if ($('#keterangan').val() == ''){
                alert("Silahkan memasukkan keterangan");
                return false;
            }else //{*/
                var form_data = $(this).serialize();
                $.ajax({
                    //untuk insert data
                    url: "<?php echo base_url(); ?>tunjangan_thr/buat_tunjangan",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        console.log("proses");
                        window.location='pemilik_daftar_thr';
                    }
                });
            //}
        });
});

function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }
</script>
    