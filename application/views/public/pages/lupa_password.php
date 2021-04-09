<section class="section_gap">
        <div class="card col-md-6 offset-md-3 mb-20 mt-20 shadow p-3 bg-white rounded">
            <div class="card-body">
                <?php echo form_open('users/lupa_password');?>
                    <div class="col-sm-8 offset-md-2">
                    <!-- Flash user reset failed message -->
                    <?php if($this->session->flashdata('reset_failed')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('reset_failed').'</p>'; ?>
                        <?php endif; ?>
                        <!-- Flash user reset success message -->
                    <?php if($this->session->flashdata('reset_success')): ?>
                            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('reset_success').'</p>'; ?>
                        <?php endif; ?>
                        <h1 class="h3 mb-3 font-weight-normal">Lupa Password</h1>
                        <div class="form-group">
                            <label for="noktp">Nomor Ktp</label>
                            <input type="text" class="form-control" id="noktp" name="noktp"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" >
                        </div>
                        <div class="form-group">
                            <label for="password_baru">Password Baru</label>
                            <input type="password" class="form-control" id="password_baru" name="password_baru" >
                        </div>
                        <div class="form-group">
                            <label for="Konfirmasi_password">Konfirmasi password</label>
                            <input type="password" class="form-control" id="Konfirmasi_password" name="Konfirmasi_password">
                        </div>
                        <button type="submit" class="btn primary-btn btn-block">
                            Selesai
                        </button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
</section> 