<?php
class pemilik extends CI_Controller
{ 
    public function cetak_laporan_keuangan(){
        $tgl_awal = $this->input->post('awal');
        $tgl_akhir = $this->input->post('sampai');
        if($tgl_awal != "" && $tgl_akhir != "" ){
        $data['pengeluaran'] = $this->Model_keuangan->ambil_data_pengeluaran($tgl_awal,$tgl_akhir);
        $data['pendapatan'] = $this->Model_keuangan->ambil_data_pendapatan($tgl_awal,$tgl_akhir);
        $data['total_pendapatan']=$this->Model_keuangan->total_pendapatan($tgl_awal,$tgl_akhir);
        $data['total_pengeluaran']=$this->Model_keuangan->total_pengeluaran($tgl_awal,$tgl_akhir);
        $data['awal']= $tgl_awal;
        $data['akhir']=$tgl_akhir;
        $tgl=date('d-m-Y');
        $data['tglhariini']=$tgl;
        $jumlah_produk = $this->Model_produk->ambil_data_jumlah_pemesanan_produk($tgl_awal,$tgl_akhir);
        // buat ngambil jumlah produk
        foreach ($jumlah_produk as $produk)
        $jmlh=$produk->jumlah; 
        //buat ngambil jumlah hari untuk menentukan biaya produksi
        $hari_kerja = $this->Model_produk->ambil_data_jumlah_hari_kerja($tgl_awal,$tgl_akhir);
        $jumlah_hari=count($hari_kerja);
        $data['tenaga_kerja']=$jumlah_hari*75000;
        $data['kayu_bakar']=($jmlh/10000)*25000;
        $data['minyak_goreng']=($jmlh/10000)*348000;
        $data['lpg']=($jmlh/10000)*8750;
        $this->load->view('pemilik/cetak_laporan',$data);
        }
        else {
            $this->session->set_flashdata('penambahan_pengeluaran_gagal', 'Silahkan isi Periode waktu');
            redirect('laporan_keuangan');
        }
    }
    public function laporan_keuangan(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
         if($level=="pemilik" && $status==true){
            $this->load->view('templates/header');
            $this->load->view('templates/navbar_pemilik');
            $this->load->view('pemilik/laporan_keuangan');
         }
         else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
            }
    }
    public function lihat_daftar_pemesanan(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
         if($level=="pemilik" && $status==true){
            $this->load->view('templates/header');
            $this->load->view('templates/navbar_pemilik');
            $this->load->view('pemilik/daftar_permintaan_sales');
         }
         else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
            }
    }
    public function riwayat_pemesanan(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
 	    if($level=="pemilik" && $status==true){
            $this->load->view('templates/header');
            $this->load->view('templates/navbar_pemilik');
            $this->load->view('pemilik/riwayat_pemesanan_sales');
         }
         else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
            }
    }
    public function daftarsales(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
 	    if($level=="pemilik" && $status==true){
            $this->load->view('templates/header');
            $this->load->view('templates/navbar_pemilik');
            $this->load->view('pemilik/daftar_sales');
         }
        else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
            }
    }
    public function daftarproduk(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
        $data['produk']= $this->Model_produk->ambil_pemilik_produk();
 	    if($level=="pemilik" && $status==true){
            $this->load->view('templates/header');
            $this->load->view('templates/navbar_pemilik');
            $this->load->view('pemilik/daftar_produk',$data);
     }
     else{
        $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
        redirect('halaman_login');
        }
    }
    public function bahan_baku(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
 	if($level=="pemilik" && $status==true){
        $this->load->view('templates/header');
        $this->load->view('templates/navbar_pemilik');
        $this->load->view('pemilik/daftar_bahan_baku');
     }
    else{
        $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
        redirect('halaman_login');
        }
    }
    public function lihat_thr(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
 	    if($level=="pemilik" && $status==true){
        $this->load->view('templates/header');
        $this->load->view('templates/navbar_pemilik');
        $this->load->view('pemilik/daftar_thr');
        }
        else{
        $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
        redirect('halaman_login');
        }
    }
    public function lihat_profile(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
        if($level=="pemilik" && $status==true){
            $username = $_SESSION['username'];
            //ambil data akun
            $data['akun'] = $this->Model_akun->pemilik_data_profile($username);
            $this->load->view('templates/header');
            $this->load->view('templates/navbar_pemilik');
            $this->load->view('pemilik/profile',$data);
        }
        else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
        }
    }
    public function buatproduk(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
 	    if($level=="pemilik" && $status==true){
            $data['bahan_baku']=$this->Model_bahan_baku->data_bahan_baku();
            $this->load->view('templates/header');
            $this->load->view('templates/navbar_pemilik');
            $this->load->view('pemilik/buatproduk',$data);
            }
            else{
                $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
                redirect('halaman_login');
            }
         }
    public function create_akun(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
 	    if($level=="pemilik" && $status==true){
        $this->load->view('templates/header');
        $this->load->view('templates/navbar_pemilik');
        $this->load->view('pemilik/create_akun');
    }
    else{
        $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
        redirect('halaman_login');
    }
    }
    public function updateProfile(){
        $noktp = $this->input->post('noktp');
        $nama = $this->input->post('nama');
        $password_baru = $this->input->post('password_baru');
        $konfirmasi = $this->input->post('konfirmasi');
        $username = $this->input->post('username');
        $password_enkripsi = hash("sha256", $this->input->post('password_baru'));
        if($nama !="" && $username!=""){
        //variabel untuk mengecek username
        $cek = $this->Model_akun->cek_data($noktp,$username);
        if($cek){
        //jika tidak mengubah username
        if($password_baru =="" && $konfirmasi==""){
         //tidak mengubah password
         $this->Model_akun->update_nama($nama,$noktp);
         $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
         redirect('pemilik_profile');
         }
        if($password_baru !="" && $konfirmasi !=""){
         //mengubah password
         if($password_baru == $konfirmasi){
             //password baru dan konfirmasi sama
             $this->Model_akun->update_nama_password($nama,$noktp,$password_enkripsi);
             $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
             redirect('pemilik_profile');
             }
         else {
             //jika tidak sama
         $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Sama.');
         redirect('pemilik_profile');
             }
        }
        else if($password_baru !="" && $konfirmasi=="" || $password_baru =="" && $konfirmasi!="" ) {
         //jika hanya memasukkan password tanpa konfirmasi dan juga sebaliknya
         $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Terisi.');
         redirect('pemilik_profile');
        }
        }
        if(!$cek){
        //jika mengubah username
        $cek_username = $this->Model_akun->cek_username($username);
        if($cek_username){
            $this->session->set_flashdata('update_failed', 'Username yang Anda masukkan sudah ada.');
            redirect('pemilik_profile');
        }
        else if(!$cek_username) {
            $cek_username_tb_sales=$this->Model_akun->cek_data__username_tabel_sales($username);
            $cek_username_tb_supplier=$this->Model_akun->cek_data__username_tabel_supplier($username);
            if($cek_username_tb_supplier == true){
                if($cek_username_tb_sales == true){
                    if($password_baru =="" && $konfirmasi==""){
                        //tidak mengubah password
                        $this->Model_akun->update_username_nama($username,$nama,$noktp);
                        $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
                        $user_data = array(
                            'username' => $username,
                            'No_ktp' => $noktp,
                            'level' => 'pemilik',
                            'logged_in' => true);    
                        $this->session->set_userdata($user_data);
                        redirect('pemilik_profile');
                        }
                    if($password_baru !="" && $konfirmasi !=""){
                            //mengubah password
                            if($password_baru == $konfirmasi){
                            //password baru dan konfirmasi sama
                            $this->Model_akun->update_username_nama_password($username,$nama,$noktp,$password_enkripsi);
                            $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
                            $user_data = array(
                                'username' => $username,
                                'No_ktp' => $noktp,
                                'level' => 'pemilik',
                                'logged_in' => true);    
                            $this->session->set_userdata($user_data);
                            redirect('pemilik_profile');
                            }
                            else {
                            //jika tidak sama
                            $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Sama.');
                            redirect('pemilik_profile');
                            }
                           }
                    else if($password_baru !="" && $konfirmasi=="" || $password_baru =="" && $konfirmasi!="" ) {
                            //jika hanya memasukkan password tanpa konfirmasi dan juga sebaliknya
                            $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Terisi.');
                            redirect('pemilik_profile');
                           }
                }else{
                    $this->session->set_flashdata('update_failed', 'Username yang Anda masukkan sudah ada.');
                    redirect('pemilik_profile');
                }
            }else{
                $this->session->set_flashdata('update_failed', 'Username yang Anda masukkan sudah ada.');
                redirect('pemilik_profile');
            }
          }
        }
        }
        else if($nama ==""|| $username==""){
            $this->session->set_flashdata('update_failed', 'Pastikan Data yang ingin dirubah sudah terisi.');
            redirect('pemilik_profile');
        }
    }
   public function create_sales(){
    $noktp = $this->input->post('no_ktp_sales');
    $nama = $this->input->post('nama_sales');
    $username = $this->input->post('username_sales');
    $pass = hash("sha256", $this->input->post('password_sales'));
    $tgl_daftar=date('Y-m-d');
    if( $noktp !="" && $nama !="" && $username != "" && $pass !=""){
        $cek=$this->Model_akun->check_noKtp_sales($noktp);
        if($cek == true){
            //No ktp tidak duplicate
            //pengecekkan data username pada tabel sales
            $username_sales=$this->Model_akun->cek_data__username_tabel_sales($username);
            if($username_sales == true){
                    //username tidak duplicate pada  tabel sales
                    //pengecekkan username pada tabel supplier
                    $username_supplier=$this->Model_akun->cek_data__username_tabel_supplier($username);
                    if($username_supplier == true){
                        //pengecekkan username pada tabel pemilik
                        $username_pemilik=$this->Model_akun->cek_data__username_tabel_pemilik($username);
                        if($username_pemilik == true){
                            //username tidak duplicate
                            $this->Model_akun->create_sales($noktp,$nama,$username,$pass,$tgl_daftar);
                            $this->session->set_flashdata('pembuatan_akun_sucess', '  Proses pembuatan akun selesai');
                            redirect('create_akun');
                         }else{
                            //username duplicate pada table pemilik
                            $this->session->set_flashdata('pembuatan_akun_gagal', '  Proses pembuatan akun gagal, Silahkan memasukkan Username yang lain');
                            redirect('create_akun');
                        }
                    }else{
                        //username duplicate pada table supplier
                        $this->session->set_flashdata('pembuatan_akun_gagal', '  Proses pembuatan akun gagal, Silahkan memasukkan Username yang lain');
                        redirect('create_akun');
                    }
            }else if($username_sales != true){
                //username duplicate pada table sales
                 $this->session->set_flashdata('pembuatan_akun_gagal', '  Proses pembuatan akun gagal, Silahkan memasukkan Username yang lain');
                 redirect('create_akun');
            }
        }else {
            //No ktp duplicate
            $this->session->set_flashdata('pembuatan_akun_gagal', '  Proses pembuatan akun gagal, No KTP sudah terdaftar pada sistem');
            redirect('create_akun');
        }
    }
    else{
        $this->session->set_flashdata('pembuatan_akun_gagal', '  Pastikan sudah mengisi data akun');
        redirect('create_akun');
    }
    }
    public function create_supplier(){
    $noktp = $this->input->post('no_ktp_supplier');
    $nama = $this->input->post('nama_supplier');
    $username = $this->input->post('username_supplier');
    $pass = hash("sha256", $this->input->post('password_supplier'));
    $tgl_daftar=date('Y-m-d');
    if( $noktp !="" && $nama !="" && $username != "" && $pass !=""){
        $cek=$this->Model_akun->check_noKtp_supplier($noktp);
        if($cek == true){
            //No ktp tidak duplicate
            //pengecekkan data username pada tabel supplier
            $username_supplier=$this->Model_akun->cek_data__username_tabel_supplier($username);
            if($username_supplier == true){
                    //username tidak duplicate pada  tabel supplier
                    //pengecekkan username pada tabel sales
                    $username_sales=$this->Model_akun->cek_data__username_tabel_sales($username);
                    if($username_sales == true){
                        //pengecekkan username pada tabel pemilik
                        $username_pemilik=$this->Model_akun->cek_data__username_tabel_pemilik($username);
                        if($username_pemilik == true){
                            //username tidak duplicate
                            $this->Model_akun->create_sales($noktp,$nama,$username,$pass,$tgl_daftar);
                            $this->session->set_flashdata('pembuatan_akun_sucess', '  Proses pembuatan akun selesai');
                            redirect('create_akun');
                         }else{
                            //username duplicate pada table pemilik
                            $this->session->set_flashdata('pembuatan_akun_gagal', '  Proses pembuatan akun gagal, Silahkan memasukkan Username yang lain');
                            redirect('create_akun');
                        }
                    }else{
                        //username duplicate pada table supplier
                        $this->session->set_flashdata('pembuatan_akun_gagal', '  Proses pembuatan akun gagal, Silahkan memasukkan Username yang lain');
                        redirect('create_akun');
                    }
            }else if($username_sales != true){
                //username duplicate pada table sales
                 $this->session->set_flashdata('pembuatan_akun_gagal', '  Proses pembuatan akun gagal, Silahkan memasukkan Username yang lain');
                 redirect('create_akun');
            }
        }else {
            //No ktp duplicate
            $this->session->set_flashdata('pembuatan_akun_gagal', '  Proses pembuatan akun gagal, No KTP sudah terdaftar pada sistem');
            redirect('create_akun');
        }
    }
    else{
        $this->session->set_flashdata('pembuatan_akun_gagal', '  Pastikan sudah mengisi data akun');
        redirect('create_akun');
    }
    }
    public function pesan_bahan_baku(){
        $status=$_SESSION['logged_in'];
            $level=$_SESSION['level'];
         if($level=="pemilik" && $status==true){
            $data['supplier']=$this->Model_supplier->ambil_data_supplier();
            $this->load->view('templates/header');
            $this->load->view('templates/navbar_pemilik');
            $this->load->view('pemilik/pesan_bahan_baku',$data);
         }
         else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
            }
    }
}
?>