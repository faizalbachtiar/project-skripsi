<section class="section_gap">
    <div class="container">
            <div class="card col-md-10 offset-md-1 mb-20 mt-25 shadow p-3 bg-white rounded">
                <div class="card-body">
                 <!-- Flash pemilik penambahan pengeluaran gagal message -->
                 <?php if($this->session->flashdata('penambahan_pengeluaran_gagal')): ?>
                    <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('penambahan_pengeluaran_gagal').'</p>'; ?>
                      <?php endif; ?>
                <h2 class="card-title title_color mb-30">Data Laporan Keuangan</h2>
                <form name="laporan" id="laporan" action="pemilik/cetak_laporan_keuangan" method="post" target="_blank">
                        <div>
                        <h6 class="card-title title_color mb-35">Dari</h6>
                        <input type="date" id="awal" name="awal"  required>
                        </div>
                        <div>
                        <h6 class="card-title title_color mb-35  mt-10">Sampai</h6>
                        <input type="date" id="sampai" name="sampai" required>
                        </div>
                        <div>
                            <br>
                            <input type="submit" name="submit" id="submit" class="btn btn-info" value="Cetak"/>
                        </div>
                </form>
            </div>
        </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#submit').click(function(){  
        if ($('#awal').val() == ''){
                alert("Silahkan isi Periode waktu");
                return false;
            }
            else if ($('#sampai').val() == ''){
                alert("Silahkan isi Periode waktu");
                return false;
            }
         
    });
    
});
</script>
