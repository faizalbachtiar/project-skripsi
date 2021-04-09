<?php
class produk extends CI_Controller
{ 
    //pengguna lihat produk
    public function searchproduk()
    {
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
          }
        // get data pengguna
        $data = $this->Model_produk->searchproduk($query);
        // table header
        $output .= '
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>';
  
        // table body
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
                        <tr>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->Nama . '</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                     <img src=../../../../ukm/assets/img/produk/'. $row->gambar . ' width="150" height="150">
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->keterangan . '</p>
                                    </div>
                                </div>
                            </td>
                        </tr>';
            }
        } else {
            // 404 data not found
            $output .= '
            <tr>
                <td ng-repeat="col in columns" class="ng-scope" colspan="6">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <br>
                            <p class="text-center text-danger">Data tidak ditemukan</p>
                        </div>
                    </div>
                </td>
            </tr>';
        }
        // end of table
        $output .= '</table>';
        // print result
        echo $output;
    }
    
    public function buat_produk(){
    $username=$_SESSION['username'];
    $data=$this->Model_akun->ambil_noktp($username);
    $noktp=$data[0];
    $nama_produk= $this->input->post('nama_produk');
    $ket=$this->input->post('keterangan');
    $harga=$this->input->post('harga');
    $potongan=$this->input->post('potongan');
    $bahan_baku=$this->input->post('bahan_baku');
    $gbr=$this->input->post('filename');
    $gambar = $_FILES['pic']['name'];
    $gmbr = str_replace(" ", "_", $gambar);
    // mecah string 
    $pic = explode('.', $gmbr);
    $ekstensi_gambar=$pic[1];
    //variabel untuk menyimpan format ekstensi file 
    $ekstensi = ['jpg', 'jpeg', 'png','JPG','JPEG','PNG'];
    //pengecekkan ektensi format file
    //seleksi format file
    if($nama_produk != "" && $ket != "" && $harga != "" && $potongan != "" && $gbr!="Pilih Gambar Yang Ingin diunggah"){
        if (in_array($ekstensi_gambar, $ekstensi)){
            //ganti nama format file sebelum di masukkan ke database 
            $namafilebaru = uniqid();
            //nama file baru 
            $nama_gambar_baru = $namafilebaru."_".$gmbr;
            $move_gambar = move_uploaded_file($_FILES['pic']['tmp_name'], FCPATH . 'assets/img/produk/' . $nama_gambar_baru);
             foreach($data as $bantu){
                 $noktp=$bantu->No_ktp;
                 $this->Model_produk->buat_produk( $bahan_baku,$noktp,$nama_produk,$harga, $ket,$potongan,$nama_gambar_baru);
                 $this->session->set_flashdata('create_produk_berhasil', 'Proses pembuatan produk selesai.');
                 redirect('pemilik_daftarproduk');
             }             
        }
        else{
            $this->session->set_flashdata('create_produk_gagal', 'Pastikan mengunggah file yang berbentuk gambar.');
            redirect('pemilik_buatproduk');
        }
    }
    else {
        $this->session->set_flashdata('create_produk_gagal', 'Silahkan Isi data pembuatan produk.');
        redirect('pemilik_buatproduk');
    }
   }
   public function hapus($No_produk){
    $data = $this->Model_produk->ambil_gambar_awal($No_produk);
            foreach($data as $bantu){
                $gbr=$bantu->gambar;
                unlink("assets/img/produk/".$gbr);   
                $this->Model_produk->hapus_produk($No_produk);
                $this->session->set_flashdata('hapus_produk_berhasil', 'proses hapus produk selesai.');
                redirect('pemilik_daftarproduk');
            }
    }
    //pemilik lihat produk
    public function pemilik_searchproduk()
    {
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
          }
        // get data pengguna
        $data = $this->Model_produk->search_pemilik_produk($query);
        // table header
        $output .= '
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Keterangan</th>
                            <th>Harga per satuan</th>
                            <th>Potongan BBM</th>
                        </tr>
                    </thead>';
  
        // table body
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $data=$row->Nama;
                $ket=$row->keterangan;
                $nama_produk = str_replace(" ", "_", $data);
                $ket_produk=str_replace(" ", "_", $ket);
                $output .= '
                        <tr>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->Nama . '</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                     <img src=../../../../ukm/assets/img/produk/'. $row->gambar . ' width="150" height="150">
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->keterangan . '</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->Harga_satuan . '</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->potongan_bbm . '</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                <button type="button" id="edit_bahan_baku" class="btn btn-info" data-toggle="modal" data-target="#edit" 
                                data-id=' . $row->No_produk . ' 
                                data-nama= '. $nama_produk .' 
                                data-gambar='. $row->gambar.' 
                                data-keterangan='. $ket_produk .' 
                                data-harga='. $row->Harga_satuan .' 
                                data-potongan='. $row->potongan_bbm .'>
                                Edit</button>
                                </div>
                            </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <a href="' . base_url('produk/hapus/' . $row->No_produk) . '"class="btn btn-info">
                                        Hapus
                                    </a>
                                </div>
                            </div>
                            </td>
                        </tr>';
            }
        } else {
            // 404 data not found
            $output .= '
            <tr>
                <td ng-repeat="col in columns" class="ng-scope" colspan="6">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <br>
                            <p class="text-center text-danger">Data tidak ditemukan</p>
                        </div>
                    </div>
                </td>
            </tr>';
        }
        // end of table
        $output .= '</table>';
        // print result
        echo $output;
    }
    
    public function edit_produk(){
        $no_produk      = $this->input->post('id_produk');
        $nama_produk        = $this->input->post('nm_produk');
        $ket_produk  = $this->input->post('ket_produk');
        $harga_produk  = $this->input->post('harga_produk');
        $potongan  = $this->input->post('potongan_produk');
        $gambar = $_FILES['pic']['name'];
        if($no_produk  !="" &&  $nama_produk   !="" && $ket_produk!= "" && $harga_produk  !="" && $potongan !=""){
        //variabel untuk menyimpan format ekstensi file 
        $ekstensi = ['jpg', 'jpeg', 'png','JPG','JPEG','PNG'];
         //pengecekkan ektensi format file
        //seleksi format file
        if($gambar != ""){
            $gmbr = str_replace(" ", "_", $gambar);
            $pic = explode('.', $gmbr);
            $ekstensi_gambar=$pic[1];
            //jika memasukkan gambar baru
            $data = $this->Model_produk->ambil_gambar_awal($no_produk);
            foreach($data as $bantu){
                $gbr=$bantu->gambar;
                if (in_array($ekstensi_gambar, $ekstensi)){
                    //menghapus file gambar lama pada direktori
                   unlink("assets/img/produk/".$gbr);
                   $namafilebaru = uniqid();
                   //nama file baru 
                    $nama_gambar_baru = $namafilebaru."_".$gmbr;
                    $move_gambar = move_uploaded_file($_FILES['pic']['tmp_name'], FCPATH . 'assets/img/produk/' . $nama_gambar_baru);
                    $this->Model_produk->edit_produk($no_produk,$nama_produk,$harga_produk, $ket_produk,$potongan,$nama_gambar_baru);
                    $this->session->set_flashdata('edit_produk_berhasil', 'proses edit produk berhasil.');              
                }else{ 
                    $this->session->set_flashdata('edit_produk_gagal', 'Pastikan Anda menggungah file yang berbentuk gambar.');  
                }
            }
        }else{
            $data = $this->Model_produk->ambil_gambar_awal($no_produk);
            foreach($data as $bantu){
            $gbr=$bantu->gambar;
            //jika tidak memasukkan gambar
            $this->Model_produk->edit_produk($no_produk,$nama_produk,$harga_produk, $ket_produk,$potongan,$gbr);
            $this->session->set_flashdata('edit_produk_berhasil', 'proses edit produk berhasil.');  
            }           
        } 
        }
        else {
            $this->session->set_flashdata('edit_produk_gagal', 'Pastikan semua sudah terisi.');  
        }
}
}
?>
<!--awal edit Modal -->
<div id="edit" class="modal fade" role="dialog" arialabelledby="modallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5>Perubahan Data Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="modal-edit">
                    <form id="form_edit">
                        <div class="form-group">
                        <label>Nama produk</label>
                        <input type="hidden" id="id_produk" name="id_produk">
                        <input type="text" class="form-control" id="nm_produk" name="nm_produk">
                        </div>
                        <div class="form-group">
                        <label>Gambar</label>
                        <div style="padding-bottom:5px" >
                          <img src="" widt="150px" height="150" id="pict">
                        </div> 
                        <input type="file" style="display:none" id="pic" name="pic">
                        <input type="button" value="Pilih Gambar"onclick="document.getElementById('pic').click()">
                        </div>
                        <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control"  id="ket_produk" name="ket_produk">
                        </div>
                        <div class="form-group">
                        <label>Harga Per satuan</label>
                        <input type="text" class="form-control"  id="harga_produk" name="harga_produk" >
                        </div>
                        <div class="form-group">
                        <label>Potongan BBM</label>
                        <input type="text" class="form-control"  id="potongan_produk" name="potongan_produk" >
                        </div>
                        <div class="modal-footer">
                        <input type="submit" class="btn btn-info"  value="Perbarui Produk">
                        </div>
                        </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        $(document).on("click","#edit_bahan_baku",function(){
            var id_produk= $(this).data('id');
            var nm_produk= $(this).data('nama');
            var nama=nm_produk.split('_').join(' ');
            var gbr_produk= $(this).data('gambar');
            var keterangan= $(this).data('keterangan');
            var ket=keterangan.split('_').join(' ');
            var harga_produk= $(this).data('harga');
            var potongan_produk= $(this).data('potongan');
            $("#modal-edit #id_produk").val(id_produk);
            $("#modal-edit #nm_produk").val(nama);
            $("#modal-edit #pict").attr("src","assets/img/produk/"+ gbr_produk);
            $("#modal-edit #ket_produk").val(ket);
            $("#modal-edit #harga_produk").val(harga_produk);
            $("#modal-edit #potongan_produk").val(potongan_produk);
        })
        $(document).ready(function (e){
            $("#form_edit").on("submit",(function(e){
                e.preventDefault();
               $.ajax({
                url : 'produk/edit_produk',
                type : 'POST',
                data : new FormData(this),
                contentType : false, 
                cache : false,
                processData : false,
                success : function(msg){
                    console.log("Proses kirim data berhasil");
                    window.location='pemilik_daftarproduk';
                }
               });
            }));
        })
        </script>
    </div>
<!--akhir edit Modal -->     