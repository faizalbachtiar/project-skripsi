<?php
class Users extends CI_Controller
{
    //untuk menampilkan tampilan awal sistem pada sisi pengguna 
    public function index($page = 'index')
    {
        if (!file_exists(APPPATH . 'views/public/pages/' . $page . '.php')) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('public/pages/' . $page);
    }
   public function profileukm(){
    $this->load->view('templates/header');
    $this->load->view('templates/navbar');
    $this->load->view('public/pages/profile_ukm');
   }
   public function Visimisiukm(){
    $this->load->view('templates/header');
    $this->load->view('templates/navbar');
    $this->load->view('public/pages/visimisi_ukm');
   }
   public function Lihatproduk(){
       $this->load->view('templates/header');
       $this->load->view('templates/navbar');
       $this->load->view('public/pages/lihat_produk');
   }
   public function lihatdaftarsales(){
    $this->load->view('templates/header');
    $this->load->view('templates/navbar');
    $this->load->view('public/pages/daftar_sales');
}
  public function halaman_login(){
    $this->load->view('templates/header');
    $this->load->view('templates/navbar');
    $this->load->view('public/pages/login');
  }  
  public function halaman_lupapassword(){
    $this->load->view('templates/header');
    $this->load->view('templates/navbar');
    $this->load->view('public/pages/lupa_password');
  }
  public function lupa_password(){
    $noktp = $this->input->post('noktp');
    $username = $this->input->post('username');
    $password = $this->input->post('password_baru');
    $konfirmasi = $this->input->post('Konfirmasi_password');
    $pass_baru=hash("sha256", $this->input->post('password_baru'));
    //pengecekkan noktp dan username tabel pemilik
    if($noktp !="" && $username !=""){
      $user= $this->Model_akun->lupa_password_pemilik($noktp, $username);
      if($user){
        if($password !="" && $konfirmasi !=""){
          if($password == $konfirmasi){
            $this->Model_akun->reset_pemilik($noktp,$pass_baru);
            $this->session->set_flashdata('reset_success', 'Password Telah dirubah.');
            redirect('lupapassword');
          }
          else{
            //$pass != $konfirmasi
            $this->session->set_flashdata('reset_failed', 'Pastikan <strong>Password baru</strong> atau <strong>Konfirmasi Password</strong> sama.');
            redirect('lupapassword');
          }
        }
        else if($password =="" && $konfirmasi ==""){
          //jika pass dan konfirmasi kosong
          $this->session->set_flashdata('reset_failed', 'Pastikan <strong>Password baru</strong> dan <strong>Konfirmasi Password</strong> telah terisi.');
          redirect('lupapassword');
        }
        else if($password !="" && $konfirmasi =="" || $password =="" && $konfirmasi !=""){
          //jika pass atau konfirmasi kosong
          $this->session->set_flashdata('reset_failed', 'Pastikan <strong>Password baru</strong> dan <strong>Konfirmasi Password</strong> telah terisi.');
          redirect('lupapassword');
        }
      }
      //pengecekkan noktp dan username tabel supplier
      $user= $this->Model_akun->lupa_password_supplier($noktp, $username);
      if($user){
        if($password !="" && $konfirmasi !=""){
          if($password == $konfirmasi){
            $this->Model_akun->reset_supplier($noktp,$pass_baru);
            $this->session->set_flashdata('reset_success', 'Password Telah dirubah.');
            redirect('lupapassword');
          }
          else{
            //$pass != $konfirmasi
            $this->session->set_flashdata('reset_failed', 'Pastikan <strong>Password baru</strong> atau <strong>Konfirmasi Password</strong> sama.');
            redirect('lupapassword');
          }
        }
        else if($password =="" && $konfirmasi ==""){
          //jika pass dan konfirmasi kosong
          $this->session->set_flashdata('reset_failed', 'Pastikan <strong>Password baru</strong> dan <strong>Konfirmasi Password</strong> telah terisi.');
          redirect('lupapassword');
        }
        else if($password !="" && $konfirmasi =="" || $password =="" && $konfirmasi !=""){
          //jika pass atau konfirmasi kosong
          $this->session->set_flashdata('reset_failed', 'Pastikan <strong>Password baru</strong> dan <strong>Konfirmasi Password</strong> telah terisi.');
          redirect('lupapassword');
        }
      }
      //pengecekkan noktp dan username tabel sales
      $user= $this->Model_akun->lupa_password_sales($noktp, $username);
      if($user){
        if($password !="" && $konfirmasi !=""){
          if($password == $konfirmasi){
            $this->Model_akun->reset_sales($noktp,$pass_baru);
            $this->session->set_flashdata('reset_success', 'Password Telah dirubah.');
            redirect('lupapassword');
          }
          else{
            //$pass != $konfirmasi
            $this->session->set_flashdata('reset_failed', 'Pastikan <strong>Password baru</strong> atau <strong>Konfirmasi Password</strong> sama.');
            redirect('lupapassword');
          }
        }
        else if($password =="" && $konfirmasi ==""){
          //jika pass dan konfirmasi kosong
          $this->session->set_flashdata('reset_failed', 'Pastikan <strong>Password baru</strong> dan <strong>Konfirmasi Password</strong> telah terisi.');
          redirect('lupapassword');
        }
        else if($password !="" && $konfirmasi =="" || $pass =="" && $konfirmasi !=""){
          //jika pass atau konfirmasi kosong
          $this->session->set_flashdata('reset_failed', 'Pastikan <strong>Password baru</strong> dan <strong>Konfirmasi Password</strong> telah terisi.');
          redirect('lupapassword');
        }
      }
      else if(!$user){
        $this->session->set_flashdata('reset_failed', '<strong>No KTP</strong> atau <strong>Username</strong> yang anda masukkan salah.');
        redirect('lupapassword');
      }
    }
    if($noktp =="" && $username ==""){
      $this->session->set_flashdata('reset_failed', 'Pastikan <strong>No KTP</strong> dan <strong>Username</strong> telah terisi.');
      redirect('lupapassword');
    }
    else if($noktp ==""){
      $this->session->set_flashdata('reset_failed', 'Pastikan <strong>No KTP</strong> telah terisi.');
      redirect('lupapassword');
    }
    else if($username ==""){
      $this->session->set_flashdata('reset_failed', 'Pastikan <strong>Username</strong> telah terisi.');
      redirect('lupapassword');
    }
  }
  public function login(){
    $username = $this->input->post('username');
    $password = hash("sha256", $this->input->post('password'));
    // pengecekkan login untuk akun pemilik
    $user_id = $this->Model_akun->pemilik_login($username, $password);
    if($user_id){
      foreach($user_id as $data){
        $user_data = array(
          'username' => $username,
          'No_ktp' => $data->No_ktp,
          'level' => 'pemilik',
          'logged_in' => true);
        }
        $this->session->set_userdata($user_data);
        redirect('home');
      }
    //pengecekkan login untuk akun sales 
    $user_id = $this->Model_akun->sales_login($username, $password);
    if($user_id){
      foreach($user_id as $data){
        $user_data = array(
          'username' => $username,
          'No_ktp' => $data->No_ktp,
          'level' => 'sales',
          'logged_in' => true);
        }
        $this->session->set_userdata($user_data);
        redirect('sales_home');
      }
      //pengecekkan login untuk akun supplier
    $user_id = $this->Model_akun->supplier_login($username, $password);
    if($user_id){
      foreach($user_id as $data){
        $user_data = array(
          'username' => $username,
          'No_ktp' => $data->No_ktp,
          'level' => 'supplier',
          'logged_in' => true);
        }
      $this->session->set_userdata($user_data);
      redirect('supplier_home');
      }
      if(!$user_id){
      // set failed login message
      $this->session->set_flashdata('login_failed', '<strong>Username</strong> atau <strong>Password</strong> yang anda masukkan salah.');
      redirect('halaman_login');
      }
  }
  public function logout(){
    $user_data = array(
      'logged_in' => false);
    $this->session->set_userdata($user_data);
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('No_ktp');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('level');

    // set failed login message
    $this->session->set_flashdata('user_loggedout', 'Anda Berhasil Logout.');
    redirect('halaman_login');
  }
  public function home(){
    $data['pemesanan']=$this->Model_produk->pemesanan();
    $this->load->view('templates/header');
    $this->load->view('templates/navbar_pemilik');
    $this->load->view('pemilik/home',$data); 
}
public function daftar_p_bahan_baku(){
  $this->load->view('templates/header');
  $this->load->view('templates/navbar_pemilik');
  $this->load->view('pemilik/daftar_pemesanan_bahan_baku');
}
public function buat_tunjangan(){
  $data['sales']=$this->Model_sales->ambil_data_sales();
  $this->load->view('templates/header');
  $this->load->view('templates/navbar_pemilik');
  $this->load->view('pemilik/halaman_tunjangan',$data);
}
}