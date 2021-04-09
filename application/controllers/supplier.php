<?php
class supplier extends CI_Controller
{
    public function ambil_bahan_baku(){
        $output = '';
        $no_ktp_supplier  = '';

        // var_dump($this->input->post('query'));

        if (!empty($this->input->post('no_ktp_supplier'))) {
            // echo $this->input->post('query');
            $no_ktp_supplier = $this->input->post('no_ktp_supplier');
        }
        // ambil data bahan baku supplier
        $data = $this->Model_supplier->ambil_bahan_baku($no_ktp_supplier);
        foreach ($data as $row) {
            $output .= '<option value="' . $row->No_bahan_baku . "/". $row->Harga. '">' . $row->Nama . '</option>';
        }
        echo $output;
    }
    public function home(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
        $noktp=$_SESSION['No_ktp'];
        //ambil data pemesanan bahan baku
        $data['pemesanan']=$this->Model_supplier->ambil_data_p_bahan_baku( $noktp);
        if($level=="supplier" && $status==true){
            $this->load->view('templates/header_pegawai');
            $this->load->view('templates/topmenu');
            $this->load->view('templates/sidebar');
            $this->load->view('supplier/home',$data);
            $this->load->view('templates/footer');
        }
        else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
        }
    }
    public function daftar_permintaan_b_baku(){
        $status=$_SESSION['logged_in'];
        $level=$_SESSION['level'];
        if($level=="supplier" && $status==true){
            $this->load->view('templates/header_pegawai');
            $this->load->view('templates/topmenu');
            $this->load->view('templates/sidebar');
            $this->load->view('supplier/daftar_permintaan_b_baku');
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
        if($level=="supplier" && $status==true){
            $username = $_SESSION['username'];
            //ambil data akun
            $data['akun'] = $this->Model_akun->supplier_data_profile($username);
            $this->load->view('templates/header_pegawai');
            $this->load->view('templates/topmenu');
            $this->load->view('templates/sidebar');
            $this->load->view('supplier/lihat_profile',$data);
            $this->load->view('templates/footer');
        }
        else{
            $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
            redirect('halaman_login');
        } 
    }
     //supplier update profile
    public function updateProfile(){
    $noktp = $this->input->post('noktp');
    $nama = $this->input->post('nama');
    $password_baru = $this->input->post('password_baru');
    $konfirmasi = $this->input->post('konfirmasi');
    $username = $this->input->post('username');
    $password_enkripsi = hash("sha256", $this->input->post('password_baru'));
    if($nama !="" && $username!=""){
    //variabel untuk mengecek username
    $cek = $this->Model_akun->cek_data_supplier($noktp,$username);
    if($cek){
    //jika tidak mengubah username
    if($password_baru =="" && $konfirmasi==""){
     //tidak mengubah password
     $this->Model_akun->update_nama_supplier($nama,$noktp);
     $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
     redirect('supplier_lihat_profile');
     }
    if($password_baru !="" && $konfirmasi !=""){
     //mengubah password
     if($password_baru == $konfirmasi){
         //password baru dan konfirmasi sama
         $this->Model_akun->update_nama_password_supplier($nama,$noktp,$password_enkripsi);
         $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
         redirect('supplier_lihat_profile');
         }
     else {
         //jika tidak sama
     $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Sama.');
     redirect('supplier_lihat_profile');
         }
    }
    else if($password_baru !="" && $konfirmasi=="" || $password_baru =="" && $konfirmasi!="" ) {
     //jika hanya memasukkan password tanpa konfirmasi dan juga sebaliknya
     $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Terisi.');
     redirect('supplier_lihat_profile');
    }
    }
    if(!$cek){
            //jika mengubah username
            $cek_username = $this->Model_akun->cek_username_supplier($username);
            if($cek_username){
                $this->session->set_flashdata('update_failed', 'Username yang Anda masukkan sudah ada.');
                redirect('supplier_lihat_profile');
            }else if(!$cek_username){
                $cek_username_tb_pemilik=$this->Model_akun->cek_data__username_tabel_pemilik($username);
                $cek_username_tb_sales=$this->Model_akun->cek_data__username_tabel_sales($username);
                if($cek_username_tb_sales == true){
                    if($cek_username_tb_pemilik == true){
                        if($password_baru =="" && $konfirmasi==""){
                            //tidak mengubah password
                            $this->Model_akun->update_username_nama_supplier($username,$nama,$noktp);
                            $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
                            $user_data = array(
                                'username' => $username,
                                'No_ktp' => $noktp,
                                'level' => 'supplier',
                                'logged_in' => true);    
                            $this->session->set_userdata($user_data);
                            redirect('supplier_lihat_profile');
                            }
                        if($password_baru !="" && $konfirmasi !=""){
                                //mengubah password
                                if($password_baru == $konfirmasi){
                                //password baru dan konfirmasi sama
                                $this->Model_akun->update_username_nama_password_supplier($username,$nama,$noktp,$password_enkripsi);
                                $this->session->set_flashdata('update_berhasil', 'Anda Telah berhasil update profile.');
                                $user_data = array(
                                    'username' => $username,
                                    'No_ktp' => $noktp,
                                    'level' => 'supplier',
                                    'logged_in' => true);    
                                $this->session->set_userdata($user_data);
                                redirect('supplier_lihat_profile');
                                }
                                else {
                                //jika tidak sama
                                $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Sama.');
                                redirect('supplier_lihat_profile');
                                }
                            }
                        else if($password_baru !="" && $konfirmasi=="" || $password_baru =="" && $konfirmasi!="" ) {
                                //jika hanya memasukkan password tanpa konfirmasi dan juga sebaliknya
                                $this->session->set_flashdata('update_failed', ' Proses ubah password Gagal Pastikan password baru dengan konfirmasi password Terisi.');
                                redirect('supplier_lihat_profile');
                            }
                    }else{
                        $this->session->set_flashdata('update_failed', 'Username yang Anda masukkan sudah ada.');
                        redirect('supplier_lihat_profile');
                    }
                }else{
                    $this->session->set_flashdata('update_failed', 'Username yang Anda masukkan sudah ada.');
                    redirect('supplier_lihat_profile');
                }
            }
    }
    }
    else if($nama ==""|| $username==""){
        $this->session->set_flashdata('update_failed', 'Pastikan Data yang ingin dirubah sudah terisi.');
        redirect('supplier_lihat_profile');
    }
}
public function daftar_b_baku(){
    $status=$_SESSION['logged_in'];
    $level=$_SESSION['level'];
    if($level=="supplier" && $status==true){
        $this->load->view('templates/header_pegawai');
        $this->load->view('templates/topmenu');
        $this->load->view('templates/sidebar');
        $this->load->view('supplier/daftar_bahan_baku');
        $this->load->view('templates/footer');
    }
    else{
        $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
        redirect('halaman_login');
    }
}
public function buat_b_baku(){
    $status=$_SESSION['logged_in'];
    $level=$_SESSION['level'];
    if($level=="supplier" && $status==true){
        $this->load->view('templates/header_pegawai');
        $this->load->view('templates/topmenu');
        $this->load->view('templates/sidebar');
        $this->load->view('supplier/buat_bahan_baku');
        $this->load->view('templates/footer');
    }
    else{
        $this->session->set_flashdata('login_failed', 'Anda Belum Masuk Kedalam Sistem.');
        redirect('halaman_login');
    }
}
public function create_b_baku(){
    $noktp = $_SESSION['No_ktp'];
    $nm_bahan_baku = $this->input->post('nm_bahan_baku');
    $Isi = $this->input->post('Isi');
    $Harga = $this->input->post('Harga');
    if( $noktp!="" && $nm_bahan_baku !="" && $Isi !="" && $Harga !=""){
        $this->Model_bahan_baku->buat_bahan_baku($noktp,$nm_bahan_baku,$Isi,$Harga);
        $this->session->set_flashdata('buat_b_baku_succes', ' Proses buat bahan baku berhasil.');
        redirect('supplier_daftar_bahan_baku');
    }
    else{
        $this->session->set_flashdata('buat_b_baku_failed', 'Pastikan form buat bahan baku sudah terisi.');
        redirect('supplier_buat_bahan_baku');
    }
}
public function hapus_b_baku($No_bahan_baku){
    $this->Model_bahan_baku->hapus_b_baku($No_bahan_baku);
    $this->session->set_flashdata('hapus_b_baku', 'proses hapus bahan baku berhasil.');
    redirect('supplier_daftar_bahan_baku');
}
public function tolak_permintaan_b_baku(){
    $no_pemesanan_b_baku = $this->input->post('No_pemesanan_bahan_baku');
    $keterangan = $this->input->post('ket_penolakan');
   if($keterangan != ""){
        $this->session->set_flashdata('penolakan_berhasil', 'Proses penolakan permintaan bahan baku  berhasil.');
        $this->Model_bahan_baku->tolak_permintaan_b_baku($no_pemesanan_b_baku,$keterangan);
        redirect('supplier_permintaan_bahan_baku');
    }
    
    else{
        $this->session->set_flashdata('penolakan_gagal', 'Silahkan Masukkan Keterangan penolakan.');
        redirect('supplier_permintaan_bahan_baku');
    }
    }
public function setujui_permintaan_b_baku(){
    $no_pemesanan_b_baku = $this->input->post('id_pemesanan_bahan_baku');
    $tgl_pengiriman=$this->input->post('tgl_pengiriman');
    if($tgl_pengiriman != ""){
        $this->session->set_flashdata('setujui_berhasil', 'Proses setujui permintaan Berhasil.');
        $this->Model_bahan_baku->setujui_permintaan_b_baku($no_pemesanan_b_baku,$tgl_pengiriman);
    }
    else{
        $this->session->set_flashdata('setujui_gagal', 'Silahkan Masukkan tanggal pengiriman.');
    }
}
}