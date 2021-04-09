<?php
class sales extends CI_Controller
{
    public function home(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
        $noktp=$_SESSION['No_ktp'];
        //ambil data sales
        $data['pemesanan']=$this->Model_sales->ambil_data_r_sales($noktp);
        if($level=="sales" && $status==true){
            $this->load->view('templates/header_pegawai');
            $this->load->view('templates/topmenu');
            $this->load->view('templates/sidebar');
            $this->load->view('sales/home',$data);
            $this->load->view('templates/footer');
        }
        else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
        }
    }
    public function halaman_pesan_produk(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
        $data['produk']=$this->Model_produk->ambil_pemilik_produk();
        if($level=="sales" && $status==true){
            $this->load->view('templates/header_pegawai');
            $this->load->view('templates/topmenu');
            $this->load->view('templates/sidebar');
            $this->load->view('sales/pesan_produk',$data);
            $this->load->view('templates/footer');
        }
        else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
        } 
    }
    public function lihat_thr(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
        if($level=="sales" && $status==true){
            $this->load->view('templates/header_pegawai');
            $this->load->view('templates/topmenu');
            $this->load->view('templates/sidebar');
            $this->load->view('sales/lihat_thr');
            $this->load->view('templates/footer');
        }
        else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
        } 
    }
    public function lihat_r_pemesanan(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
        if($level=="sales" && $status==true){
            
            $this->load->view('templates/header_pegawai');
            $this->load->view('templates/topmenu');
            $this->load->view('templates/sidebar');
            $this->load->view('sales/riwayat_pemesanan_sales');
            $this->load->view('templates/footer');
        }
        else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
        } 
    }
    public function lihat_profile(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
        if($level=="sales" && $status==true){
            $username = $_SESSION['username'];
            //ambil data akun
            $data['akun'] = $this->Model_akun->sales_data_profile($username);
            $this->load->view('templates/header_pegawai');
            $this->load->view('templates/topmenu');
            $this->load->view('templates/sidebar');
            $this->load->view('sales/lihat_profile',$data);
            $this->load->view('templates/footer');
        }
        else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
        } 
    }
    public function searchsales()
  {
      $output = '';
      $query = '';
      if ($this->input->post('query')) {
          $query = $this->input->post('query');
        }
      // get data pengguna
      $data = $this->Model_sales->searchsales($query);
      // table header
      $output .= '
              <table class="table">
                  <thead>
                      <tr>
                          <th>Nama </th>
                          <th>alamat</th>
                          <th>status</th>
                          <th>tanggal daftar</th>
                      </tr>
                  </thead>';

      // table body
      if ($data->num_rows() > 0) {
          foreach ($data->result() as $row) {
              if($row->alamat){
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
                                <p>' . $row->alamat . '</p>
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
                                <p>' . $row->tgl_daftar . '</p>
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
                                <p>' . $row->Nama . '</p>
                            </div>
                        </div>
                    </td>
                    <td ng-repeat="col in columns" class="ng-scope">
                        <div ng-switch="" on="col.renderType">
                            <div ng-switch-when="primaryLink" class="ng-scope">
                                <p> Belum ada data alamat</p>
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
                                <p>' . $row->tgl_daftar . '</p>
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
  //sales update profile
  public function updateProfile(){
    $noktp = $this->input->post('noktp');
    $nama = $this->input->post('nama');
    $alamat = $this->input->post('Alamat');
    $password_baru = $this->input->post('password_baru');
    $konfirmasi = $this->input->post('konfirmasi');
    $username = $this->input->post('username');
    $password_enkripsi = hash("sha256", $this->input->post('password_baru'));
    if($nama !="" && $username!="" && $alamat!=""){
    //variabel untuk mengecek username
    $cek = $this->Model_akun->cek_data_sales($noktp,$username);
    if($cek){
    //jika tidak mengubah username
    if($password_baru =="" && $konfirmasi==""){
     //tidak mengubah password
     $this->Model_akun->update_nama_sales($nama,$noktp,$alamat);
     $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
     redirect('lihat_profile');
     }
    if($password_baru !="" && $konfirmasi !=""){
     //mengubah password
     if($password_baru == $konfirmasi){
         //password baru dan konfirmasi sama
         $this->Model_akun->update_nama_password_sales($nama,$noktp,$password_enkripsi,$alamat);
         $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
         redirect('lihat_profile');
         }
     else {
         //jika tidak sama
     $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Sama.');
     redirect('lihat_profile');
         }
    }
    else if($password_baru !="" && $konfirmasi=="" || $password_baru =="" && $konfirmasi!="" ) {
     //jika hanya memasukkan password tanpa konfirmasi dan juga sebaliknya
     $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Terisi.');
     redirect('lihat_profile');
    }
    }
    if(!$cek){
            //jika mengubah username
            $cek_username = $this->Model_akun->cek_username_sales($username);
            if($cek_username){
                $this->session->set_flashdata('update_failed', 'Username yang Anda masukkan sudah ada.');
                redirect('lihat_profile');
            
            }else if(!$cek_username){
                $cek_username_tb_pemilik=$this->Model_akun->cek_data__username_tabel_pemilik($username);
                $cek_username_tb_supplier=$this->Model_akun->cek_data__username_tabel_supplier($username);
                if($cek_username_tb_supplier == true){
                    if($cek_username_tb_pemilik == true){
                        if($password_baru =="" && $konfirmasi==""){
                            //tidak mengubah password
                            $this->Model_akun->update_username_nama_sales($username,$nama,$noktp,$alamat);
                            $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
                            $user_data = array(
                                'username' => $username,
                                'No_ktp' => $noktp,
                                'level' => 'sales',
                                'logged_in' => true);    
                            $this->session->set_userdata($user_data);
                            redirect('lihat_profile');
                            }
                        if($password_baru !="" && $konfirmasi !=""){
                                //mengubah password
                                if($password_baru == $konfirmasi){
                                //password baru dan konfirmasi sama
                                $this->Model_akun->update_username_nama_password_sales($username,$nama,$noktp,$password_enkripsi,$alamat);
                                $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
                                $user_data = array(
                                    'username' => $username,
                                    'No_ktp' => $noktp,
                                    'level' => 'sales',
                                    'logged_in' => true);    
                                $this->session->set_userdata($user_data);
                                redirect('lihat_profile');
                                }
                                else {
                                //jika tidak sama
                                $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Sama.');
                                redirect('lihat_profile');
                                }
                            }
                        else if($password_baru !="" && $konfirmasi=="" || $password_baru =="" && $konfirmasi!="" ) {
                                //jika hanya memasukkan password tanpa konfirmasi dan juga sebaliknya
                                $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Terisi.');
                                redirect('lihat_profile');
                            }
                    }else{
                        $this->session->set_flashdata('update_failed', 'Username yang Anda masukkan sudah ada.');
                        redirect('ihat_profile');
                    }
                }else{
                    $this->session->set_flashdata('update_failed', 'Username yang Anda masukkan sudah ada.');
                    redirect('lihat_profile');// pengecekkan sudah sampai sini dan berjalan
                }
            }
    }
    }
    else if($nama ==""|| $username=="" || $alamat==""){
        $this->session->set_flashdata('update_failed', 'Pastikan Data yang ingin dirubah sudah terisi.');
        redirect('lihat_profile');
    }
}
public function pesan_produk(){
    //noktp sales 
    $no_ktp_sales=$_SESSION['No_ktp'];
    $data_sales=$this->Model_sales-> ambil_nama($no_ktp_sales);    
    $data_diri=$data_sales[0];
    //nama sales 
    $nama_sales=$data_diri->Nama;
    $no_produk      = $this->input->post('produk');
    $jumlah        = $this->input->post('jumlah_produk');
    $tgl_pemasaran  = $this->input->post('tgl_pemasaran');
    date_default_timezone_set('Asia/Jakarta');
    $tgl_pemesanan=date('Y-m-d');
    $waktu=date('H:i:s');
    $penambahan_pemesanan=0;
    if($no_produk !="" && $jumlah !="" && $tgl_pemasaran !=""){
    // jika memasukkan data
    $data_produk=$this->Model_produk->ambildata_harga($no_produk);
    $data=$data_produk[0];
    $harga=$data->Harga_satuan;
    $ktp_pemilik=$data->No_ktp_pemilik;
    $nama_produk=$data->Nama;
    $potongan=$data->potongan_bbm;
    /// seleksi harga satuan untuk setoran 
    if($harga == 100 ){
        $setoran=(($jumlah*62)-$potongan);
        $this->Model_produk->simpan_p_produk($no_ktp_sales,$ktp_pemilik,$no_produk,$nama_produk,$jumlah,$tgl_pemesanan,$tgl_pemasaran ,$nama_sales,$waktu,$setoran);
    }elseif($harga == 200){
        $setoran=(($jumlah*124)-$potongan);
        $this->Model_produk->simpan_p_produk($no_ktp_sales,$ktp_pemilik,$no_produk,$nama_produk,$jumlah,$tgl_pemesanan,$tgl_pemasaran ,$nama_sales,$waktu,$setoran);
    }elseif( $harga == 500 ){
        $setoran=($jumlah*310)-$potongan;
        $this->Model_produk->simpan_p_produk($no_ktp_sales,$ktp_pemilik,$no_produk,$nama_produk,$jumlah,$tgl_pemesanan,$tgl_pemasaran ,$nama_sales,$waktu,$setoran);
    }else {
        $setoran=(($jumlah*$harga)-$potongan);
        $this->Model_produk->simpan_p_produk($no_ktp_sales,$ktp_pemilik,$no_produk,$nama_produk,$jumlah,$tgl_pemesanan,$tgl_pemasaran ,$nama_sales,$waktu,$setoran); 
    }
    // jika ada penambahan pemesanan produk
    $number = count($_POST["nama"]);
    for($i=0;$i<$number;$i++)
                {
                  //selesi inputan penambahan produk
                    if(trim($_POST["nama"][$i] != '') && trim($_POST["jumlah"][$i] != '') && trim($_POST["tanggal"][$i] != ''))
                    {
                      $penambahan_pemesanan++;
                       //no produk
                       $data_no_produk[$i] = $_POST["nama"][$i];
                       //jumlah 
                       $data_jumlah_produk[$i] = $_POST["jumlah"][$i];
                       //tanggal pemasaran 
                       $data_tgl_produk[$i]= $_POST["tanggal"][$i];
                       $data_pemesanan=$this->Model_produk->ambildata_harga($_POST["nama"][$i]);
                       //ngambil data harga 
                       $dt=$data_pemesanan[0];
                       $data_harga[]=$dt->Harga_satuan;
                       //ambil data potongan
                       $data_potongan[]=$dt->potongan_bbm; 
                       //nama
                       $data_nama_produk[]=$dt->Nama;
                       //noktp pemilik 
                       $data_ktp_pemilik[]=$dt->No_ktp_pemilik; 
                         // seleksi setoran 
                        if($data_harga[$i] == 100){
                          $data_setoran[]=($data_jumlah_produk[$i]*62)-$data_potongan[$i];
                           }
                        elseif ($data_harga[$i] == 200){
                          $data_setoran[]=($data_jumlah_produk[$i]*124)-$data_potongan[$i];
                          }
                        elseif($data_harga[$i] == 500){
                          $data_setoran[]=($data_jumlah_produk[$i]*310)-$data_potongan[$i];
                          }
                        else{
                          $data_setoran[]=($data_jumlah_produk[$i]*$data_harga[$i])-$data_potongan[$i];
                          }
                      }
                } 
                     //perulangan untuk insert data kedatabase ketika terdapat penambahan pemesanan produk
                     for($i=0;$i<$penambahan_pemesanan;$i++){
                       $this->Model_produk->simpan_p_produk($no_ktp_sales,$data_ktp_pemilik[$i],$data_no_produk[$i],$data_nama_produk[$i],$data_jumlah_produk[$i],$tgl_pemesanan,$data_tgl_produk[$i] ,$nama_sales,$waktu,$data_setoran[$i]);
                     }
        $this->session->set_flashdata('pemesanan_berhasil', 'Proses Pemesanan produk berhasil.');
        redirect('lihat_r_pemesanan');
    }
    //ini akhir if pengecekkan inputan pemesanan utama 
    else{
      //jika tidak menginputkan data
        $this->session->set_flashdata('pemesanan_gagal', 'Pastikan anda memasukkan data pemesanan produk.');
        redirect('pesan_produk');
    }
}
}