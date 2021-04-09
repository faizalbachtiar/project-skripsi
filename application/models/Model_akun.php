<?php 
class Model_akun extends CI_Model
{
    // login pemilik
    public function pemilik_login($username, $password)
    {
        $this->db->select('Username, Password, No_ktp');
        $this->db->from('pemilik');
        $this->db->where('Username', $username);
        $this->db->where('Password', $password);
        $this->db->limit(1);

        $result = $this->db->get();
         if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }
    // login supplier
    public function supplier_login($username, $password)
    {
        $this->db->select('Username, Password, No_ktp');
        $this->db->from('supplier');
        $this->db->where('Username', $username);
        $this->db->where('Password', $password);
        $this->db->limit(1);

        $result = $this->db->get();
         if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }
    //login sales
    public function sales_login($username, $password)
    {
        $this->db->select('Username, Password, No_ktp');
        $this->db->from('sales');
        $this->db->where('Username', $username);
        $this->db->where('Password', $password);
        $this->db->limit(1);

        $result = $this->db->get();
         if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }
    
    //ambil data akun pemilik 
    public function pemilik_data_profile($username){
     $this->db->select('*');
     $this->db->from('pemilik');
     $this->db->where('Username', $username);
     $hasil = $this->db->get();
     return $hasil->result();
    }
    //ambil data akun sales
    public function sales_data_profile($username){
    $this->db->select('*');
    $this->db->from('sales');
    $this->db->where('Username', $username);
    $hasil = $this->db->get();
    return $hasil->result();
    }
    //ambil data akun supplier
    public function supplier_data_profile($username){
        $this->db->select('*');
        $this->db->from('supplier');
        $this->db->where('Username', $username);
        $hasil = $this->db->get();
        return $hasil->result();
        }
    //pengecekkan username jika tidak dirubah
    //pemilik
    public function cek_data($noktp,$username){
        $this->db->select('username');
        $this->db->from('pemilik');
        $this->db->where('No_ktp', $noktp);
        $this->db->where('Username',$username);
        $result = $this->db->get();
        if ($result->num_rows() == 1) {
           return $result->result();
       } else {
           return false;
       }
    }
    //sales
    public function cek_data_sales($noktp,$username){
        $this->db->select('username');
        $this->db->from('sales');
        $this->db->where('No_ktp', $noktp);
        $this->db->where('Username',$username);
        $result = $this->db->get();
        if ($result->num_rows() == 1) {
           return $result->result();
       } else {
           return false;
       }
    }
    //supplier
    public function cek_data_supplier($noktp,$username){
        $this->db->select('username');
        $this->db->from('supplier');
        $this->db->where('No_ktp', $noktp);
        $this->db->where('Username',$username);
        $result = $this->db->get();
        if ($result->num_rows() == 1) {
           return $result->result();
       } else {
           return false;
       }
    }
    
    //update data pemilik tanpa merubah username
    //supplier
    public function update_nama_supplier($nama,$noktp){
        $data = array(
            'nama' => $nama
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('supplier', $data);
    }
    //sales
    public function update_nama_sales($nama,$noktp,$alamat){
        $data = array(
            'nama' => $nama,
            'alamat'=> $alamat
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('sales', $data);
    }
    //pemilik
    public function update_nama($nama,$noktp){
        $data = array(
            'nama' => $nama
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('pemilik', $data);
    }

    //update data pemilik tanpa merubah username
    //supplier
    public function update_nama_password_supplier($nama,$noktp,$password_enkripsi){
        $data = array(
            'nama' => $nama,
            'Password' =>$password_enkripsi
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('supplier', $data);
    }
    //sales
    public function update_nama_password_sales($nama,$noktp,$password_enkripsi,$alamat){
        $data = array(
            'nama' => $nama,
            'Password' =>$password_enkripsi,
            'alamat'=>$alamat
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('sales', $data);
    }
    ///pemilik
    public function update_nama_password($nama,$noktp,$password_enkripsi){
        $data = array(
            'nama' => $nama,
            'Password' =>$password_enkripsi
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('pemilik', $data);
    }
    //pengecekkan username jika dirubah
    //supplier
    public function cek_username_supplier($username){
        $this->db->select('username');
        $this->db->from('supplier');
        $this->db->where('Username',$username);
        $result = $this->db->get();
        if ($result->num_rows() == 1) {
           return $result->result();
       } else {
           return false;
       }
    }
    //sales
    public function cek_username_sales($username){
        $this->db->select('username');
        $this->db->from('sales');
        $this->db->where('Username',$username);
        $result = $this->db->get();
        if ($result->num_rows() == 1) {
           return $result->result();
       } else {
           return false;
       }
    }
    //pemilik
    public function cek_username($username){
        $this->db->select('username');
        $this->db->from('pemilik');
        $this->db->where('Username',$username);
        $result = $this->db->get();
        if ($result->num_rows() == 1) {
           return $result->result();
       } else {
           return false;
       }
    }
    //awal update data merubah username
    //pemilik
    public function update_username_nama($username,$nama,$noktp){
        $data = array(
            'Username'=>$username,
            'nama' => $nama
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('pemilik', $data);
    }
    //sales
    public function update_username_nama_sales($username,$nama,$noktp,$alamat){
        $data = array(
            'Username'=>$username,
            'nama' => $nama,
            'alamat' =>$alamat
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('sales', $data);
    }
    //supplier
    public function update_username_nama_supplier($username,$nama,$noktp){
        $data = array(
            'Username'=>$username,
            'nama' => $nama
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('supplier', $data);
    }
    //akhir update data merubah username
    //pemilik
    public function update_username_nama_password($username,$nama,$noktp,$password_enkripsi){
        $data = array(
            'Username'=>$username,
            'nama' => $nama,
            'Password' =>$password_enkripsi
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('pemilik', $data);
    }
    //sales
    public function update_username_nama_password_sales($username,$nama,$noktp,$password_enkripsi,$alamat){
        $data = array(
            'Username'=>$username,
            'nama' => $nama,
            'Password' =>$password_enkripsi,
            'alamat'=>$alamat
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('sales', $data);
    }
     //supplier
     public function update_username_nama_password_supplier($username,$nama,$noktp,$password_enkripsi){
        $data = array(
            'Username'=>$username,
            'nama' => $nama,
            'Password' =>$password_enkripsi
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('supplier', $data);
    }
    //pengecekkan no ktp dan username untuk lupa password pada tabel pemilik
    public function lupa_password_pemilik($noktp, $username){
        $this->db->select('Username, No_ktp');
        $this->db->from('pemilik');
        $this->db->where('Username', $username);
        $this->db->where('No_ktp', $noktp);
        $this->db->limit(1);
        $result = $this->db->get();
         if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }
    //pengecekkan no ktp dan username untuk lupa password pada tabel supplier
    public function lupa_password_supplier($noktp, $username){
        $this->db->select('Username, No_ktp');
        $this->db->from('supplier');
        $this->db->where('No_ktp', $noktp);
        $this->db->where('Username', $username);
        $this->db->limit(1);
        $result = $this->db->get();
         if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }
    //pengecekkan no ktp dan username untuk lupa password pada tabel sales
    public function lupa_password_sales($noktp, $username){
        $this->db->select('Username, No_ktp');
        $this->db->from('sales');
        $this->db->where('Username', $username);
        $this->db->where('No_ktp', $noktp);
        $this->db->limit(1);
        $result = $this->db->get();
         if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }

    //pemilik reset password
    public function reset_pemilik($noktp,$pass_baru){
        $data = array(
            'Password' => $pass_baru
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('pemilik', $data);
    }
    //sales reset password
    public function reset_sales($noktp,$pass_baru){
        $data = array(
            'Password' => $pass_baru
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('sales', $data);
    }
    //supplier reset password
    public function reset_supplier($noktp,$pass_baru){
        $data = array(
            'Password' => $pass_baru
        );
        $this->db->where('No_ktp', $noktp);
        $this->db->update('supplier', $data);
    }
    //ambil no ktp pemilik
    public function ambil_noktp($username){
        $this->db->select('No_ktp');
        $this->db->from('pemilik');
        $this->db->where('Username', $username);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function check_noKtp_sales($noktp){
        $query = $this->db->get_where('sales', array(
            'No_ktp' => $noktp
        ));

        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }
    
    public function check_noKtp_supplier($noktp){
        $query = $this->db->get_where('supplier', array(
            'No_ktp' => $noktp
        ));

        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    } 
    //pada tabel sales
    public function cek_data__username_tabel_sales($username){
        $query = $this->db->get_where('sales', array(
            'Username' => $username
        ));

        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }
    //pada tabel pemilik
    public function cek_data__username_tabel_pemilik($username){
        $query = $this->db->get_where('pemilik', array(
            'Username' => $username
        ));

        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }
    //pada tabel supplier
    public function cek_data__username_tabel_supplier($username){
        $query = $this->db->get_where('supplier', array(
            'Username' => $username
        ));

        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    //insert akun sales
    public function create_sales($noktp,$nama,$username,$pass,$tgl_daftar){
        $this->db->trans_begin();
        $data = array(
            'No_ktp' => $noktp,
            'Username'      => $username,
            'Password'   => $pass,
            'Nama'     => $nama,
            'status'=>'terdaftar',
            'tgl_daftar'=>$tgl_daftar
           
        );
        $this->db->insert('sales', $data);

        if ($this->db->trans_status() === FALSE) {
            // rollback transaction when something gone wrong
            $this->db->trans_rollback();
        } else {
            // commit when everything is okay, asooy
            $this->db->trans_commit();
        }
    }

    //insert akun supplier
    public function create_supplier($noktp,$nama,$username,$pass){
        $this->db->trans_begin();
        $data = array(
            'No_ktp' => $noktp,
            'Username'      => $username,
            'Password'   => $pass,
            'Nama'     => $nama,
           
        );
        $this->db->insert('supplier', $data);

        if ($this->db->trans_status() === FALSE) {
            // rollback transaction when something gone wrong
            $this->db->trans_rollback();
        } else {
            // commit when everything is okay, asooy
            $this->db->trans_commit();
        }
    }
}
?>