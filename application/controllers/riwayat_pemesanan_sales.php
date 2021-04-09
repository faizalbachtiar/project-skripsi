<?php
class riwayat_pemesanan_sales extends CI_Controller
{
    public function search(){
        $noktp = $_SESSION['No_ktp'];
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
          }
        // get data pengguna
        $data = $this->Model_sales->pemesanan_sales($noktp,$query);
        // table header
        $output .= '
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Waktu</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Pemasaran</th>
                            <th>Setoran</th>
                            <th>Status</th>
                        </tr>
                    </thead>';
  
        // table body
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                if($row->status == "ditolak"){
                    $data=$row->keterangan;
                    $keterangan = str_replace(" ", "_", $data);
                    $output .= '
                    <tr>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->Nama_produk . '</p>
                                </div>
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
                                    <p>' . $row->setoran . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                <button type="button" id="keterangan" class="btn btn-info" data-toggle="modal" data-target="#keterangan" 
                                data-keterangan=' . $keterangan . '>
                                ' . $row->status . '</button>  
                                </div>
                            </div>
                        </td>
                    </tr>'; 
                } else if($row->status == "Setoran kurang"){
                    $output .= '
                    <tr>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                    <p>' . $row->Nama_produk . '</p>
                                </div>
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
                                    <p>' . $row->setoran . '</p>
                                </div>
                            </div>
                        </td>
                        <td ng-repeat="col in columns" class="ng-scope">
                            <div ng-switch="" on="col.renderType">
                                <div ng-switch-when="primaryLink" class="ng-scope">
                                <button type="button" id="setoran_kurang" class="btn btn-info" data-toggle="modal" data-target="#setoran_kurang" 
                                data-setoran=' . $row->setoran_yang_dibayar . '
                                data-kurang=' . $row->kekurangan_setoran . '>
                                ' . $row->status . '</button>  
                                </div>
                            </div>
                        </td>
                    </tr>'; 
                }
                else{
                    $output .= '
                  <tr>
                      <td ng-repeat="col in columns" class="ng-scope">
                          <div ng-switch="" on="col.renderType">
                              <div ng-switch-when="primaryLink" class="ng-scope">
                                  <p>' . $row->Nama_produk . '</p>
                              </div>
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
                                  <p>' . $row->setoran . '</p>
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
   
}?>

<!----awal modal lihat kekurangan setoran pada sisi sales----->
<div id="setoran_kurang" class="modal fade" role="dialog" arialabelledby="modallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
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
<!----akhir modal lihat kekurangan setoran pada sisi sales----->

<!--awal keterangan Modal untuk sisi sales -->
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
<!--akhir keterangan Modal untuk sisi sales--> 
<script>
        $(document).on("click","#keterangan",function(){
            var keterangan= $(this).data('keterangan');
            var ket=keterangan.split('_').join(' ');
            $("#modal-keterangan #keterangan").text(ket);
        })
        $(document).on("click","#setoran_kurang",function(){
            var setoran= $(this).data('setoran');
            var kurang= $(this).data('kurang');
            $("#modal-kekurangan #setoran").text(setoran);
            $("#modal-kekurangan #kurang").text(kurang);
        })
</script>