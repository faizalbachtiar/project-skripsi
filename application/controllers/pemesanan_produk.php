<?php
class pemesanan_produk extends CI_Controller
{
public function setujui($No_pemesanan,$jumlah ){
// pengecekkan jumlah bahan baku terlebih dahulu 
$data=$this->Model_produk->ambil_data($No_pemesanan);
foreach( $data as $bahan_baku){
    $berat= $bahan_baku->berat;
    $isi = $bahan_baku->isi;
    $no=$bahan_baku->No_bahan_baku_ukm;
    $jumlah_total=$berat*$isi;
    //pengecekkan jumlah
    $cek=$jumlah_total-($jumlah+($jumlah*0.1));
    //berat sisa
    $berat_sisa=$cek/$isi;
    if($cek>0){
       //update data pemesanan diterima 
       $this->Model_produk->ubah_status_pemesanan($No_pemesanan);
       //ubah data jumlah 
       $this->Model_bahan_baku->update_jumlah_stock($no,$berat_sisa);
       $this->session->set_flashdata('permintaan_produk_diterima', 'permintaan produk disetujui.');
       redirect('permintaan_sales');
    }
    else {
        $this->session->set_flashdata('permintaan_produk_ditolak', 'bahan baku tidak memenuhi syarat untuk menerima permintaan produk');
        redirect('permintaan_sales');
    }
}
}
    
    // live search daftar permintaan sales 
    public function searchrequest(){
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
          }
        // get data pengguna
        $data = $this->Model_produk->searchpermintaan($query);
        // table header
        $output .= '
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Sales</th>
                            <th>Nama produk</th>
                            <th>Jumlah</th>
                            <th>Waktu</th>
                            <th>tanggal pemesanan</th>
                            <th>tanggal pemasaran</th>
                            <th>status</th>
                        </tr>
                    </thead>';
  
        // table body
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                if($row->status == "diproses" ){
                    $output .= '
                    <tr>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->Nama_sales . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Nama_produk . '</p> </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->jumlah . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->waktu . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->tgl_pemesanan . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->tgl_pemasaran . '</p>
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
                                <a href="' . base_url('pemesanan/produk/'. $row->No_pemesanan.'/'. $row->jumlah ) . '" class="btn btn-info">
                                    Setujui
                                </a>
                            </div>
                        </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                            <button type="button" id="tolak_pemesanan_produk" class="btn btn-info" data-toggle="modal" data-target="#tolak" 
                            data-id=' . $row->No_pemesanan. '>
                            Tolak</button>
                            </div>
                        </div>
                        </td>
                    </tr>';
                }
                elseif($row->status == "ditolak" ){
                $ket=$row->keterangan;
                $keterangan=str_replace(" ", "_", $ket);
                    $output .= '
                    <tr>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->Nama_sales . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>' . $row->Nama_produk . '</p> </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->jumlah . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->waktu . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->tgl_pemesanan . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->tgl_pemasaran . '</p>
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
                            <button type="button" id="keterangan_pemesanan_produk" class="btn btn-info" data-toggle="modal" data-target="#keterangan" 
                            data-keterangan=' . $keterangan. '>
                            Keterangan</button>
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
    public function tolak_pemesanan(){
        $No_pemesanan                = $this->input->post('id_pemesanan');
        $keterangan_penolakan        = $this->input->post('ket_penolakan');
        $this->Model_produk->tolak_pemesanan_produk($No_pemesanan,$keterangan_penolakan );
        $this->session->set_flashdata('permintaan_produk_ditolak', 'penolakan permintaan produk berhasil.');
       }
}
?>
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

<!--awal tolak Modal -->   
<div id="tolak" class="modal fade" role="dialog" arialabelledby="modallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5>Keterangan Penolakan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="modal-tolak">
                    <form id="form_tolak">
                        <div class="form-group">
                        <input type="hidden" id="id_pemesanan" name="id_pemesanan">
                        <input type="text" class="form-control" id="ket_penolakan" name="ket_penolakan">
                        </div>
                        <div class="modal-footer">
                        <input type="submit" class="btn btn-info"  value="Selesai">
                        </div>
                        </form>
                </div>
            </div>
        </div>
</div>
<!--end tolak Modal -->  
<script type="text/javascript">
        $(document).on("click","#keterangan_pemesanan_produk",function(){
            var keterangan= $(this).data('keterangan');
            var ket=keterangan.split('_').join(' ');
            $("#modal-keterangan #keterangan").text(ket);
        })
        $(document).on("click","#tolak_pemesanan_produk",function(){
            var no_pemesanan= $(this).data('id');
            $("#modal-tolak #id_pemesanan").val(no_pemesanan);
        })
        $(document).ready(function (e){
            $("#form_tolak").on("submit",(function(e){
                 //awal  insert data tolak pemesanan
                if ($('#ket_penolakan').val() == ''){
                alert("Silahkan Masukkan Keterangan penolakan");
                return false;
            }
            else{
               e.preventDefault();
               $.ajax({
                url : 'tolak_pemesanan_produk',
                type : 'POST',
                data : new FormData(this),
                contentType : false, 
                cache : false,
                processData : false,
                success : function(msg){
                    console.log("Proses Penolakan Berjalan");
                    window.location='permintaan_sales';
                }
               });
            }
            }));
            //akhir  insert data tolak pemesanan
        })
</script>    