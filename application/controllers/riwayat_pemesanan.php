<?php
class riwayat_pemesanan extends CI_Controller
{
    // live serch riwayat permintaan sales pada sisi pemilik 
    public function riwayat(){
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
          }
        // get data pengguna
        $data = $this->Model_produk->riwayat_permintaan($query);
        // table header
        $output .= '
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Sales</th>
                            <th>Nama produk</th>
                            <th>Jumlah</th>
                            <th>Setoran</th>
                            <th>tanggal pemesanan</th>
                            <th>tanggal pemasaran</th>
                            <th>status</th>
                        </tr>
                    </thead>';
  
        // table body
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                if($row->status == "setujui"){
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
                                    <p>Rp. ' . $row->setoran. '</p>
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
                            <button type="button" id="tb_kekurangan_setoran" class="btn btn-info" data-toggle="modal" data-target="#kekurangan_setoran" 
                            data-id=' . $row->No_pemesanan . '>
                            Setoran Kurang</button>
                            </div>
                        </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                            <a href="' . base_url('konfirmasi_pembayaran/' . $row->No_pemesanan) . '"class="btn btn-info">
                                        Selesai
                            </a>
                            </div>
                        </div>
                        </td>
                    </tr>';
                }else if($row->status == "Setoran kurang"){
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
                                    <p>Rp.' . $row->setoran. '</p>
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
                            <button type="button" id="tb_setoran_kurang" class="btn btn-info" data-toggle="modal" data-target="#setoran" 
                                data-setoran=' . $row->setoran_yang_dibayar . '
                                data-kurang=' . $row->kekurangan_setoran . '>
                                Lihat Kekurangan Setoran</button> 
                            </div>
                        </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                            <a href="' . base_url('konfirmasi_pembayaran/' . $row->No_pemesanan) . '"class="btn btn-info">
                                        Selesai
                            </a>
                            </div>
                        </div>
                        </td>
                    </tr>';
                }else if($row->status == "selesai"){
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
                                    <p>Rp.' . $row->setoran. '</p>
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
    public function kekurangan_setoran(){
        $no_pemesanan = $this->input->post('No_pemesanan');
        $setoran_yang_dibayar = $this->input->post('setoran_yangdibayar');
        $setoran_kurang = $this->input->post('setoran_kurang');
        if( $setoran_yang_dibayar !="" &&  $setoran_kurang !=""){
            $this->Model_produk->setoran_kurang($no_pemesanan,$setoran_yang_dibayar,$setoran_kurang);
            $this->session->set_flashdata('proses_input_kekurangan_succes', 'Proses selesai.');
            redirect('riwayat_pemesanan');
        }
        else{
            $this->session->set_flashdata('proses_input_kekurangan_failed', 'Pastikan Anda sudah mengisi semua data yang diperlukan.');
            redirect('riwayat_pemesanan');
        }
    }
    public function pembayaran_selesai($No_pemesanan){
        $this->Model_produk->konfirmasi_pembayaran($No_pemesanan);
        $this->session->set_flashdata('konfirmasi_pembayaran', 'Proses konfirmasi setoran sales selesai.');
        redirect('riwayat_pemesanan');
    }
}
?>
<!----awal modal kekurangan setoran pada sisi pemilik----->
<div id="kekurangan_setoran" class="modal fade" role="dialog" arialabelledby="modallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                         <label >Setoran sales</label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="modal-kekurangan">
                    <form id="form_kekurangan_setoran" action="riwayat_pemesanan/kekurangan_setoran" method="POST">
                    <div class="form-group">
                        <label >Setoran yang dibayar</label>
                        <input type="text" id="No_pemesanan" style="display:none" name="No_pemesanan">
                        <input type="text" class="form-control" id="setoran_yangdibayar" name="setoran_yangdibayar" onkeypress="return hanyaAngka(event)">
                        </div>
                        <div class="form-group">
                        <label >Kekurangan Setoran</label>
                        <input type="text" class="form-control"  id="setoran_kurang" name="setoran_kurang" onkeypress="return hanyaAngka(event)">
                        </div>
                        <div class="modal-footer">
                        <input type="submit" class="btn btn-info"  value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<!----akhir modal kekurangan setoran pada sisi pemilik----->


<!----awal modal lihat kekurangan setoran pada sisi pemilik----->
<div id="setoran" class="modal fade" role="dialog" arialabelledby="modallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                         <label >Setoran sales</label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="modal-kekurangan">
                    <form>
                        <div class="form-group">
                        <h4>Setoran yang dibayar : </h4>
                        <h6 id="setoran" name="setoran"></h6>
                        <h4>Setoran yang belum dibayar :</h4>
                        <h6 id="kurang" name="kurang"></h6>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!----akhir modal lihat kekurangan setoran pada sisi pemilik----->
<script type="text/javascript">
function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }
        $(document).on("click","#tb_kekurangan_setoran",function(){
            var id= $(this).data('id');
            $("#modal-kekurangan #No_pemesanan").val(id);
        })
        $(document).on("click","#tb_setoran_kurang",function(){
            var setoran= $(this).data('setoran');
            var kurang= $(this).data('kurang');
            $("#modal-kekurangan #setoran").text(setoran);
            $("#modal-kekurangan #kurang").text(kurang);
        })
    </script>