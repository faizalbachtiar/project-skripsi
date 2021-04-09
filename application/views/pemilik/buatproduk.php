<section class="section_gap">
    <div class="container">
            <div class="card col-md-10 offset-md-1 mb-20 mt-25 shadow p-3 bg-white rounded">
                <div class="card-body">
                <!-- Flash pemilik create produk failed message -->
                <?php if($this->session->flashdata('create_produk_gagal')): ?>
                            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('create_produk_gagal').'</p>'; ?>
                        <?php endif; ?>
                <?php echo form_open_multipart('produk/buat_produk');?>
                <h2 class="card-title title_color mb-30">Buat Produk</h2>
                <h6 class="card-title title_color mb-35">Nama Produk</h6>
                <input type="text" id="nama_produk" name="nama_produk">
                <h6 class="card-title title_color mb-35">Nama Bahan Baku</h6>
                    <select name="bahan_baku" id="bahan_baku" style="width: 100%; height:35px">
                        <option value="">Nama Bahan Baku</option>
                            <?php foreach ($bahan_baku as $data) : ?>
                                        <option value='<?php echo $data->No_bahan_baku_ukm; ?>'>
                                            <?php echo $data->nama; ?>
                                        </option>
                            <?php endforeach; ?>
                    </select>
                <h6 class="card-title title_color mb-35">Gambar </h6>
                <input type="file" id="pic" name="pic"style="display:none" onchange="document.getElementById('filename').value=this.value">
                <input type="text" id="filename" name="filename" value="Pilih Gambar Yang Ingin diunggah">
                <input type="button" value="Pilih Gambar" onclick="document.getElementById('pic').click()">
                <h6 class="card-title title_color mb-35">Keterangan</h6>
                <input type="text" id="keterangan" name="keterangan">
                <h6 class="card-title title_color mb-35">Harga Satuan</h6>
                <input type="text" id="harga" name="harga" onkeypress="return hanyaAngka(event)">
                <h6 class="card-title title_color mb-35">Potongan BBM</h6>
                <input type="text" id="potongan" name="potongan" onkeypress="return hanyaAngka(event)">
                </div>
                <button type="submit" class="btn primary-btn btn-block">
                            Simpan Produk
                </button>
                <?php echo form_close(); ?>
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