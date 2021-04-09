<div id="main">
            <div class="card col-md-12 mb-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                 <!-- Flash pemilik update failed message -->
                 <?php if($this->session->flashdata('update_failed')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('update_failed').'</p>'; ?>
                        <?php endif; ?>
                 <!-- Flash pemilik update Succes message -->
                 <?php if($this->session->flashdata('update_berhasil')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('update_berhasil').'</p>'; ?>
                        <?php endif; ?>
                <?php echo form_open('sales/updateProfile'); ?>
                <h2 class="card-title title_color mb-30">Data Diri </h2>
                <div class="f_form">
                        <?php foreach($akun as $data) : ?>
                            <div class="form-group">
                                <label for="noktp">No KTP</label>
                                <input type="text" class="form-control" id="noktp" name="noktp" value= "<?php echo $data->No_ktp?>"  readonly >
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"  value ="<?php echo $data->Nama?>">
                            </div>
                            <div class="form-group">
                                <label for="Alamat">Alamat</label>
                                <input type="text" class="form-control" id="Alamat" name="Alamat" value="<?php echo $data->alamat ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $data->Username ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Password Baru</label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru" value="" >
                            </div>  
                            <div class="form-group">
                                <label for="email">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" value="">
                            </div>
                        <?php endforeach; ?>
                        <button type="submit" value="submit" class="btn primary-btn btn-block">
                            Perbarui Data Diri
                        </button> 
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>