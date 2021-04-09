<?php
class permintaan_bahan_baku extends CI_Controller
{
    public function permintaan(){
        $noktp=$_SESSION['No_ktp'];
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
          }
        // get data pengguna
        $data = $this->Model_bahan_baku->permintaan_b_baku($query,$noktp);
        // table header
        $output .= '
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Bahan Baku</th>
                            <th>Berat</th>
                            <th>Tanggal dipesan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Tanggal Pengiriman</th>
                        </tr>
                    </thead>';
  
        // table body
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                if($row->status == 'diterima'){
                    $output .= '
                    <tr>
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
                                    <p>' . $row->Berat . ' Kg </p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->tgl_dipesan . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>Selesai</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>Selesai</p>
                            </div>
                        </div>
                        <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>'. $row->tgl_pengiriman .'</p>
                            </div>
                        </div>
                    </td>
                    </tr>';
                }
                else if($row->status == 'tolak'){
                    $output .= '
                    <tr>
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
                                    <p>' . $row->Berat . ' Kg </p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->tgl_dipesan . '</p>
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
                                <p>' . $row->keterangan . '</p>
                            </div>
                        </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p>-</p>
                            </div>
                        </div>
                        </td>
                    </tr>';
                }else if($row->status == 'diproses'){
                    $output .= '
                    <tr>
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
                                    <p>' . $row->Berat . ' Kg </p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->tgl_dipesan . '</p>
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
                                    <p>-</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>-</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                            <button type="button" id="terima_permintaan_b_baku" class="btn btn-info" data-toggle="modal" data-target="#setuju"
                            data-id=' . $row->No_pemesanan_bahan_baku. ' 
                            >Setujui</button>
                            </div>
                        </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                            <button type="button" id="tolak_permintaan_b_baku" class="btn btn-info" data-toggle="modal" data-target="#tolak"
                            data-id=' . $row->No_pemesanan_bahan_baku. ' 
                            >Tolak</button>
                            </div>
                        </div>
                        </td>
                    </tr>';
                }else if($row->status == 'setujui'){
                    $output .= '
                    <tr>
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
                                    <p>' . $row->Berat . ' Kg </p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->tgl_dipesan . '</p>
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
                                <p>Siap Dikirim</p>
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
}?>

<!--awal setujui Modal-->
<div id="setuju" class="modal fade" role="dialog" arialabelledby="modallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5>Tanggal Pengiriman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body" id="modal-setujui">
                    <form id="form_setujui">
                        <div class="form-group">
                        <input type="hidden" id="id_pemesanan_bahan_baku" name="id_pemesanan_bahan_baku">
                        <input type="date" class="form-control" id="tgl_pengiriman" name="tgl_pengiriman">
                        </div>
                        <div class="modal-footer">
                        <input type="submit" class="btn btn-info"  value="Selesai">
                        </div>
                        </form>
                </div>
            </div>
        </div>
</div>

<!--akhir setujui Modal-->

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
                        <form id="form_tolak" action="supplier/tolak_permintaan_b_baku" method="post">
                        <div class="form-group">
                        <input type="hidden" id="No_pemesanan_bahan_baku" name="No_pemesanan_bahan_baku">
                        <input type="text" class="form-control" id="ket_penolakan" name="ket_penolakan">
                        </div>
                        <div class="modal-footer">
                        <input type="submit" class="btn btn-info"  value="Simpan">
                        </div>
                        </form>
                </div>
            </div>
        </div>
</div>
<!--end tolak Modal -->  
<script type="text/javascript">
        $(document).on("click","#terima_permintaan_b_baku",function(){
            var No_pemesanan_bahan_baku= $(this).data('id');
            $("#modal-setujui #id_pemesanan_bahan_baku").val(No_pemesanan_bahan_baku);
        })
        $(document).on("click","#tolak_permintaan_b_baku",function(){
            var No_pemesanan_bahan_baku= $(this).data('id');
            $("#modal-tolak #No_pemesanan_bahan_baku").val(No_pemesanan_bahan_baku);
        })
        $(document).ready(function (event){
           $("#form_setujui").on("submit",(function(event){
                if ($('#tgl_pengiriman').val() == ''){
                alert("Silahkan Masukkan Tanggal Pengiriman");
                return false;
            }
            else{
                event.preventDefault();
               $.ajax({
                url : 'setujui_permintaan_b_baku',
                type : 'POST',
                data : new FormData(this),
                contentType : false, 
                cache : false,
                processData : false,
                success : function(msg){
                    window.location='supplier_permintaan_bahan_baku';
                }
               });
            }
            }));

        })
</script>   