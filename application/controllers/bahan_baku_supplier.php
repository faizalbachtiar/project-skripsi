<?php
class bahan_baku_supplier extends CI_Controller
{
   public function daftar_b_baku(){
    $noktp=$_SESSION['No_ktp'];
    $output = '';
    $query = '';
    if ($this->input->post('query')) {
        $query = $this->input->post('query');
      }
    // get data pengguna
    $data = $this->Model_bahan_baku->bahan_baku_supplier($query,$noktp);
    // table header
    $output .= '
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Bahan Baku</th>
                        <th>Isi</th>
                        <th>Harga</th>
                    </tr>
                </thead>';

    // table body
    if ($data->num_rows() > 0) {
        foreach ($data->result() as $row) {
            $data=$row->Nama;
            $nama_bahan_baku = str_replace(" ", "_", $data);
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
                                <p>' . $row->Harga . ' /Kg </p>
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
                        <a href="' . base_url('bahan_baku/hapus/' . $row->No_bahan_baku) . '"class="btn btn-info">
                                        Hapus
                                    </a>
                    </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                    <div ng-switch="" on="col.renderType">
                        <div ng-switch-when="primaryLink" class="ng-scope">
                        <button type="button" id="edit_bahan_baku" class="btn btn-info" data-toggle="modal" data-target="#edit"
                        data-id=' . $row->No_bahan_baku. ' 
                        data-nama='. $nama_bahan_baku.' 
                        data-harga='. $row->Harga .' 
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
public function edit_bahan_baku_supplier(){
    $no_bahan_baku      = $this->input->post('id_b_baku');
    $nama_bahan_baku        = $this->input->post('nm_b_baku');
    $harga            = $this->input->post('harga_b_baku');
    $isi  = $this->input->post('isi_b_baku');
    if( $no_bahan_baku !="" && $nama_bahan_baku !="" && $harga !="" && $isi !="" ){
        $this->Model_bahan_baku->edit_bahan_baku_supplier($no_bahan_baku,$nama_bahan_baku,$harga,$isi);
        $this->session->set_flashdata('succes_edit_bahan_baku', 'Proses edit bahan baku berhasil.');
    }
    else{
        $this->session->set_flashdata('succes_failed_bahan_baku', 'Pastikan data bahan baku terisi.');
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
                    <form id="form_edit">
                        <div class="form-group">
                        <label >Nama</label>
                        <input type="hidden" id="id_b_baku" name="id_b_baku">
                        <input type="text" class="form-control" id="nm_b_baku" name="nm_b_baku">
                        </div>
                        <div class="form-group">
                        <label >Isi /Kg</label>
                        <input type="text" class="form-control"  id="isi_b_baku" name="isi_b_baku"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                        <div class="form-group">
                        <label >Harga /Kg</label>
                        <input type="text" class="form-control"  id="harga_b_baku" name="harga_b_baku"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                        <div class="modal-footer">
                        <input type="submit" class="btn btn-info"  value="Simpan">
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on("click","#edit_bahan_baku",function(){
            var id_b_baku= $(this).data('id');
            var nama_b_baku= $(this).data('nama');
            var nama=nama_b_baku.split('_').join(' ');
            var harga_b_baku= $(this).data('harga');
            var isi_b_baku= $(this).data('isi');
            $("#modal-edit #id_b_baku").val(id_b_baku);
            $("#modal-edit #nm_b_baku").val(nama);
            $("#modal-edit #harga_b_baku").val(harga_b_baku);
            $("#modal-edit #isi_b_baku").val(isi_b_baku);
            console.log(id_b_baku);
        })
        $(document).ready(function (e){
            $("#form_edit").on("submit",(function(e){
                e.preventDefault();
               $.ajax({
                url : 'edit_bahan_baku_supplier',
                type : 'POST',
                data : new FormData(this),
                contentType : false, 
                cache : false,
                processData : false,
                success : function(msg){
                    console.log("Proses kirim data berhasil");
                    window.location='supplier_daftar_bahan_baku';
                }
               });
            }));
        })
        </script>
<!--akhir edit Modal -->     