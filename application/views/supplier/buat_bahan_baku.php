<div id="main">
    <div class="card col-md-10 shadow md-5 p-10 offset-md-1 bg-white rounded">
        <div class="card-body">
        <!-- Flash buat bahan baku failed message -->
        <?php if($this->session->flashdata('buat_b_baku_failed')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('buat_b_baku_failed').'</p>'; ?>
        <?php endif; ?>
            <h2 class="mb-15 card-title">Buat Bahan Baku</h2>
            <hr>
            <?php echo form_open('supplier/create_b_baku'); ?>
            <div class="form-group">
                <label for="nm_bahan_baku">Nama Bahan Baku</label>
                <div class="mt-10">
                    <input type="text" name="nm_bahan_baku" id="nm_bahan_baku"  class="single-input form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="Isi">Isi /Kg</label>
                <div class="mt-10">
                    <input type="text" name="Isi" id="Isi"  class="single-input form-control"  onkeypress="return hanyaAngka(event)">
                </div>
            </div>
            <div class="form-group">
                <label for="Harga">Harga /Kg</label>
                <div class="mt-10">
                    <input type="text" name="Harga" id="Harga"  class="single-input form-control"  onkeypress="return hanyaAngka(event)">
                </div>
            </div>
            <button class="btn btn-primary p-10" type="submit">Simpan</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }
</script>