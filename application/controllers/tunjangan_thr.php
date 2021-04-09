<?php 
class tunjangan_thr extends CI_Controller{
    public function thr_sales(){
        $noktp = $_SESSION['No_ktp'];
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
          }
        //query terkirim
        $data = $this->Model_tunjangan_hr->thr_sales($noktp,$query);
        // table header
        $output .= '
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>';
  
        // table body
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $ket=$row->keterangan;
                $keterangan=str_replace(" ", "_", $ket);
                 $output .= '
                  <tr>
                      <td ng-repeat="col in columns" class="ng-scope">
                          <div ng-switch="" on="col.renderType">
                              <div ng-switch-when="primaryLink" class="ng-scope">
                                  <p>' . $row->tanggal . '</p>
                              </div>
                          </div>
                      </td>
                      <td ng-repeat="col in columns" class="ng-scope">
                          <div ng-switch="" on="col.renderType">
                              <div ng-switch-when="primaryLink" class="ng-scope">
                                  <p>Rp. ' . $row->nilai . '</p>
                              </div>
                          </div>
                      </td>
                      <td ng-repeat="col in columns" class="ng-scope">
                          <div ng-switch="" on="col.renderType">
                          <div ng-switch-when="primaryLink" class="ng-scope">
                          <button type="button" id="keterangan" class="btn btn-info" data-toggle="modal" data-target="#keterangan" 
                          data-keterangan=' . $keterangan. ' 
                          >Keterangan</button>
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
    //search tunjangan hari raya aktor pemilik
    public function search_thr()
    {
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
          }
        // get data pengguna
        $data = $this->Model_tunjangan_hr->search_thr($query);
        // table header
        $output .= '
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Sales</th>
                            <th>Tanggal</th>
                            <th>Nilai</th>
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
                                        <p>' . $row->nama_sales . '</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->tanggal . '</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p>' . $row->nilai . '</p>
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
public function buat_tunjangan(){
    $No_ktp_pemilik=$_SESSION['No_ktp'];
    $No_ktp_sales   = $this->input->post('No_ktp_sales');
    $tgl        = $this->input->post('tgl');
    $nilai      = $this->input->post('nilai');
    $keterangan = $this->input->post('keterangan');
    if($No_ktp_sales != "" && $tgl != "" && $nilai != "" && $keterangan != ""){
        // ambil nama sales
        $nama= $this->Model_tunjangan_hr->ambil_data($No_ktp_sales);
            $nm=$nama[0];
            $nama_sales=$nm->Nama;
            //insert data ke tabel tunjangan
            $insert= $this->Model_tunjangan_hr->save_tunjangan($No_ktp_pemilik,$No_ktp_sales,$nama_sales,$tgl, $nilai,$keterangan);
            $this->session->set_flashdata('create_tunjangan_succes', 'Pembuatan tunjangan hari raya berhasil');
    }
    else {
        $this->session->set_flashdata('create_tunjangan_failed', 'Proses pembuatan tunjangan hari raya Gagal, pastikan anda memasukkan semua data yang dibutuhkan');
    }
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
                    <form id="form_edit">
                        <div class="form-group">
                        <h4>keterangan</h4></br>
                        <h6 id="keterangan" name="keterangan"></h6>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on("click","#keterangan",function(){
            var keterangan= $(this).data('keterangan');
            var ket=keterangan.split('_').join(' ');
            $("#modal-keterangan #keterangan").text(ket);
        })
        </script>
<!--akhir keterangan Modal -->    