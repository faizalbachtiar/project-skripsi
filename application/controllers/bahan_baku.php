<?php 
class bahan_baku extends CI_Controller{

public function search_bahan_baku(){
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
          }
        // get data pengguna
        $data = $this->Model_bahan_baku->search_bahan_baku($query);
        // table header
        $output .= '
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Berat</th>
                            <th>Isi</th>
                            <th>Isi Total</th>
                        </tr>
                    </thead>';
  
        // table body
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $data=$row->nama;
                $nama_bahan_baku = str_replace(" ", "_", $data);
                $output .= '
                        <tr>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->nama . '</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->berat . ' Kg </p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->isi . ' /Kg</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->isi*$row->berat . ' Pcs</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                <button type="button" id="edit_bahan_baku" class="btn btn-info" data-toggle="modal" data-target="#edit" 
                                data-id=' . $row->No_bahan_baku_ukm. ' 
                                data-nama='. $nama_bahan_baku.' 
                                data-berat='. $row->berat .' 
                                data-isi='. $row->isi .'
                                >Edit</button>
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

public function search_pemesanan_bahan_baku(){
    $output = '';
    $query = '';
    if ($this->input->post('query')) {
        $query = $this->input->post('query');
      }
    // get data pengguna
    $data = $this->Model_bahan_baku->search_pemesanan_bahan_baku($query);
    // table header
    $output .= '
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Supplier</th>
                        <th>Nama Bahan Baku</th>
                        <th>Berat</th>
                        <th>Isi</th>
                        <th>Tanggal Pengiriman</th>
                        <th>Status</th>
                        <th>Harga Total</th>
                    </tr>
                </thead>';

    // table body
    if ($data->num_rows() > 0) {
        foreach ($data->result() as $row) {
            if($row->status =="setujui"){
                $output .= '
                <tr>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Nama_supplier . '</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Nama_bahan_baku . '</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Berat . ' Kg</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->isi . '/Kg</p>
                            </div>
                        </div>
                    </td> 
                    <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p>' . $row->tgl_pengiriman . '</p>
                        </div>
                    </div>
                </td>
                <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p>' . $row->status . '</p>
                        </div>
                    </div>
                </td>
                <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p>' . $row->harga_total . '</p>
                        </div>
                    </div>
                </td>
                
                   <td ng-repeat="col in columns" class="ng-scope">
                  <div ng-switch="" on="col.renderType">
                      <div ng-switch-when="primaryLink" class="ng-scope">
                        <a href="' . base_url('bahan_baku/konfirmasi/' . $row->No_pemesanan_bahan_baku .'/'. $row->No_bahan_baku) . '"class="btn btn-info">
                            Terima
                        </a>
                      </div>
                  </div>
                  </td>
                </tr>';
            }
            else if($row->status =="diproses"){
                $output .= '
                <tr>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Nama_supplier . '</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Nama_bahan_baku . '</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Berat . ' Kg</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->isi . '/Kg</p>
                            </div>
                        </div>
                    </td> 
                    <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p> Masih diproses</p>
                        </div>
                    </div>
                </td>
                <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p>' . $row->status . '</p>
                        </div>
                    </div>
                </td>
                <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p>' . $row->harga_total . '</p>
                        </div>
                    </div>
                </td>
                
                   <td ng-repeat="col in columns" class="ng-scope">
                  <div ng-switch="" on="col.renderType">
                      <div ng-switch-when="primaryLink" class="ng-scope">
                          <a href="" class="btn btn-info disabled" >
                              Terima
                          </a>
                      </div>
                  </div>
                  </td>
                </tr>';
            }
            else if($row->status =="diterima"){
                $output .= '
                <tr>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Nama_supplier . '</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Nama_bahan_baku . '</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Berat . ' Kg</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->isi . '/Kg</p>
                            </div>
                        </div>
                    </td> 
                    <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p>' . $row->tgl_pengiriman . '</p>
                        </div>
                    </div>
                </td>
                <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p>' . $row->status . '</p>
                        </div>
                    </div>
                </td>
                <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p>' . $row->harga_total . '</p>
                        </div>
                    </div>
                </td>
                
                   <td ng-repeat="col in columns" class="ng-scope">
                  <div ng-switch="" on="col.renderType">
                      <div ng-switch-when="primaryLink" class="ng-scope">
                          <a href="" class="btn btn-info disabled" >
                              Selesai
                          </a>
                      </div>
                  </div>
                  </td>
                </tr>';
            }else if($row->status =="tolak"){
                $ket=$row->keterangan;
                $keterangan=str_replace(" ", "_", $ket);
                $output .= '
                <tr>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Nama_supplier . '</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Nama_bahan_baku . '</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Berat . ' Kg</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->isi . '/Kg</p>
                            </div>
                        </div>
                    </td> 
                    <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p> Masih diproses</p>
                        </div>
                    </div>
                </td>
                <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p>' . $row->status . '</p>
                        </div>
                    </div>
                </td>
                <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                            <p>' . $row->harga_total . '</p>
                        </div>
                    </div>
                </td>
                
                   <td ng-repeat="col in columns" class="ng-scope">
                  <div ng-switch="" on="col.renderType">
                      <div ng-switch-when="primaryLink" class="ng-scope">
                      <button type="button" id="keterangan_b_baku" class="btn btn-info" data-toggle="modal" data-target="#keterangan" 
                      data-keterangan=' . $keterangan . ' >
                      keterangan</button>    
                      </div>
                  </div>
                  </td>
                </tr>';
            }
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
public function konfirmasi($No_pemesanan_bahan_baku,$No_bahan_baku){
$noktp=$_SESSION['No_ktp'];
//pengecekkan pada tabel bahan baku ukm 
$cek = $this->Model_bahan_baku->cek_bahan_baku_ukm($No_bahan_baku);
if($cek){
    foreach($cek as $data_stock){
            $berat_awal=$data_stock->berat;
            //jika bahan baku ada maka
            $bahan_baku=$this->Model_bahan_baku->ambil_data_pemesanan_bahan_baku($No_pemesanan_bahan_baku);
            foreach ($bahan_baku as $data){
             $berat=$data->Berat;
             $berat_akhir=$berat+$berat_awal;
             $isi_bahan_baku=$this->Model_bahan_baku->ambil_data_isi($No_bahan_baku);
             foreach($isi_bahan_baku as $data_isi){
                 $isi=$data_isi->isi;
            //update stock bahan baku
            $this->session->set_flashdata('konfirmasi_succes', 'Bahan Baku Berhasil diterima');
            $this->Model_bahan_baku->update_b_baku($No_bahan_baku,$berat_akhir,$isi);
            //ubah status pemesanan 
            $this->Model_bahan_baku->update_status($No_pemesanan_bahan_baku);
            redirect('pemilik_daftar_p_bahan_baku');
            }}}
} 
else {
    $bahan_baku=$this->Model_bahan_baku->ambil_data_pemesanan_bahan_baku($No_pemesanan_bahan_baku);
    foreach ($bahan_baku as $data){
        $berat=$data->Berat;
        $nama=$data->Nama_bahan_baku;
        $isi_bahan_baku=$this->Model_bahan_baku->ambil_data_isi($No_bahan_baku);
             foreach($isi_bahan_baku as $data_isi){
             $isi=$data_isi->isi;
             $this->session->set_flashdata('konfirmasi_succes', 'Bahan Baku Berhasil diterima');
            //insert bahan baku ukm soalnya bahan baku baru
            $this->Model_bahan_baku->insert_b_baku($No_bahan_baku,$noktp,$nama,$berat,$isi);
            //ubah status pemesanan 
            $this->Model_bahan_baku->update_status($No_pemesanan_bahan_baku);
            redirect('pemilik_daftar_p_bahan_baku');
            }}
}
}
public function pesan_bahan_baku(){
    $noktp=$_SESSION['No_ktp'];
    $no_bahan_baku      = $this->input->post('no_bahan_baku');
    $no_ktp_supplier = $this->input->post('No_ktp_supplier');
    $berat            = $this->input->post('berat');
    $harga_total  = $this->input->post('harga');
    if($no_bahan_baku != "" && $no_ktp_supplier!="" && $berat !="" && $harga_total!="" ){
        $harga = explode('.', $harga_total);
        $data_harga_total=$harga[1];
        $tgl_dipesan=date('Y-m-d');
        // mengambil nama sales 
        $nama_supplier = $this->Model_supplier->ambil_nama($no_ktp_supplier);
        $supplier = $nama_supplier[0];
        $data_supplier = $supplier->Nama;
            //mengambil nama bahan baku
            $nama_bahan_baku = $this->Model_supplier->ambil_data_bahan_baku($no_bahan_baku);
                $bahan_baku=$nama_bahan_baku[0];
                $data_bahan_baku=$bahan_baku->Nama;
                $this->session->set_flashdata('succes_pesan_bahan_baku', 'Proses Pesan Bahan Baku Berhasil.');
                $this->Model_bahan_baku->pesan_bahan_baku($noktp,$no_ktp_supplier,$no_bahan_baku,$data_supplier,$data_bahan_baku,$berat,$tgl_dipesan,$data_harga_total); 
    }
    else{
        $this->session->set_flashdata('failed_pesan_bahan_baku', 'Pastikan sudah mengisi semua data yang diperlukan.');
    }
}
public function edit_bahan_baku()
{
    $no_bahan_baku_ukm      = $this->input->post('id_b_baku');
    $nama_bahan_baku        = $this->input->post('nm_b_baku');
    $berat            = $this->input->post('brt_b_baku');
    $isi  = $this->input->post('isi_b_baku');
    if($no_bahan_baku_ukm != "" && $nama_bahan_baku != "" && $berat  !="" &&  $isi !="" ){
        $this->Model_bahan_baku->edit_bahan_baku($no_bahan_baku_ukm,$nama_bahan_baku,$berat,$isi);
        $this->session->set_flashdata('succes_edit_bahan_baku', 'Proses perubahan data berhasil.');
        redirect('pemilik_bahanbaku');
    }else{
        $this->session->set_flashdata('failed_edit_bahan_baku', 'Silahkan isi data bahan baku.');
        redirect('pemilik_bahanbaku');
    }
}
}

?>
<!--awal edit Modal -->
<div id="edit" class="modal fade" role="dialog" arialabelledby="modallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5>Perubahan Bahan Baku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="modal-edit">
                    <form id="form_edit" action="edit_bahan_baku" method="post">
                        <div class="form-group">
                        <label >Nama</label>
                        <input type="hidden" id="id_b_baku" name="id_b_baku">
                        <input type="text" class="form-control" id="nm_b_baku" name="nm_b_baku">
                        </div>
                        <div class="form-group">
                        <label >Berat Kg</label>
                        <input type="text" class="form-control"  id="brt_b_baku" name="brt_b_baku" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                        <div class="form-group">
                        <label >Isi /Kg</label>
                        <input type="text" class="form-control"  id="isi_b_baku" name="isi_b_baku"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                        <div class="modal-footer">
                        <input type="submit" class="btn btn-info"  value="Simpan">
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
<!--akhir edit Modal -->     

<!--awal keterangan Modal -->
<div id="keterangan" class="modal fade" role="dialog" arialabelledby="modallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="modal-keterangan">
                    <form>
                        <div class="form-group">
                        <h4>keterangan</h4></br>
                        <h6 id="keterangan" name="keterangan"></h6>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--akhir keterangan Modal -->   
<script type="text/javascript">
        $(document).on("click","#keterangan_b_baku",function(){
            var keterangan= $(this).data('keterangan');
            var ket=keterangan.split('_').join(' ');
            $("#modal-keterangan #keterangan").text(ket);
        })
        $(document).on("click","#edit_bahan_baku",function(){
            var id_b_baku= $(this).data('id');
            var nama_b_baku= $(this).data('nama');
            var nama=nama_b_baku.split('_').join(' ');
            var berat_b_baku= $(this).data('berat');
            var isi_b_baku= $(this).data('isi');
            $("#modal-edit #id_b_baku").val(id_b_baku);
            $("#modal-edit #nm_b_baku").val(nama);
            $("#modal-edit #brt_b_baku").val(berat_b_baku);
            $("#modal-edit #isi_b_baku").val(isi_b_baku);
        })
        </script>