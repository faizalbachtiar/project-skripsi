<section class="section_gap">
<div class="container">
    <div class="card col-md-12 shadow md-5 p-3 bg-white rounded">
        <div class="card-body">
        <!-- Flash pemilik pembuatan akun succes message -->
        <?php if($this->session->flashdata('pembuatan_akun_sucess')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('pembuatan_akun_sucess').'</p>'; ?>
        <?php endif; ?>
       <!-- Flash pemilik pembuatan akun failed message -->
        <?php if($this->session->flashdata('pembuatan_akun_gagal')): ?>
                <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('pembuatan_akun_gagal').'</p>'; ?>
        <?php endif; ?>
            <h3 class="card-title mb-30">Buat Akun</h3>
            <h4 class="card-title mb-30">Kategori Akun</h4>
            <div class="radio-area" id="radio-area">
                <input type="radio" id="radio1" name="radios" value="all" onclick="javascript:operatorCategory();" checked>
                <label for="radio1">Sales</label>
                <input type="radio" id="radio2" name="radios" value="all" onclick="javascript:operatorCategory();">
                <label for="radio2">Supplier</label>
            </div>
            <hr>
            <div id="salesfield" style="display: block;">
                <?php echo form_open('pemilik/create_sales'); ?>
                <h3 class=" card-title title_color mb-30">Pembuatan Akun Sales</h3>
                    <div class="accordion" id="sertifikasi_dam">
                        <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="no_ktp_sales">Nomor KTP</label>
                                            <div class="mt-10">
                                                <input type="text" name="no_ktp_sales" id="no_ktp_sales" class="single-input form-control" onkeypress="return hanyaAngka(event)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_sales">Nama Sales</label>
                                            <div class="mt-10">
                                                <input type="text" name="nama_sales" id="nama_sales"  class="single-input form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username_sales">Username</label>
                                            <div class="mt-10">
                                                <input type="text" name="username_sales" id="username_sales"  class="single-input form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_sales">Password</label>
                                            <div class="mt-10">
                                                <input type="password" name="password_sales" id="password_sales"   class="single-input form-control">
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                <br>
                <button type="submit" class="btn btn-block primary-btn">Buat Akun</button>
                <?php echo form_close(); ?>
            </div>
            <div id="supplierfield" style="display: none;">
                <?php echo form_open('pemilik/create_supplier'); ?>
                <h3 class=" card-title title_color mb-30">Pembuatan Akun Supplier</h3>
                    <div class="accordion" id="supplier">
                        <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="no_ktp_supplier">Nomor KTP</label>
                                        <div class="mt-10">
                                            <input type="text" name="no_ktp_supplier" id="no_ktp_supplier"  class="single-input form-control" onkeypress="return hanyaAngka(event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_supplier">Nama Supplier</label>
                                        <div class="mt-10">
                                            <input type="text" name="nama_supplier" id="nama_supplier"  class="single-input form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username_supplier">Username</label>
                                        <div class="mt-10">
                                            <input type="text" name="username_supplier" id="username_supplier" class="single-input form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_supplier">Password</label>
                                        <div class="mt-10">
                                            <input type="password" name="password_supplier" id="password_supplier"  class="single-input form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                <br>
                <button type="submit" class="btn btn-block primary-btn">Buat Akun</button>
                <?php echo form_close(); ?>
            </div>
        </div>
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
</script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
