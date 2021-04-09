<?php 
class Model_sales extends CI_Model
{
    public function searchsales($query){
        $this->db->select('*');
        $this->db->from('sales');
        if ($query != '') {
            $this->db->like('sales.Nama', $query);
            $this->db->or_like('sales.alamat', $query); 
            $this->db->or_like('sales.status', $query); 
            $this->db->or_like('sales.tgl_daftar', $query);
        }
        return $this->db->get();
        
    }
    public function pemesanan_sales($noktp,$query){
        $this->db->select('*');
        $this->db->from('pemesanan_produk');
        $this->db->where('No_ktp_sales',$noktp);
        if ($query != '') {
            $this->db->like('pemesanan_produk.Nama_produk', $query);
            $this->db->where('No_ktp_sales',$noktp);
            $this->db->or_like('pemesanan_produk.jumlah', $query); 
            $this->db->where('No_ktp_sales',$noktp);
            $this->db->or_like('pemesanan_produk.tgl_pemesanan', $query);
            $this->db->where('No_ktp_sales',$noktp);
            $this->db->or_like('pemesanan_produk.tgl_pemasaran', $query);
            $this->db->where('No_ktp_sales',$noktp);
            $this->db->or_like('pemesanan_produk.setoran', $query); 
            $this->db->where('No_ktp_sales',$noktp);
            $this->db->or_like('pemesanan_produk.status', $query);
            $this->db->where('No_ktp_sales',$noktp);
        }
        return $this->db->get();
        
    }   
    public function ambil_data_sales(){
        $this->db->select('*');
        $this->db->from('sales');
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function ambil_data_r_sales($noktp){
        $this->db->select('*');
        $this->db->from('pemesanan_produk');
        $this->db->where('No_ktp_sales', $noktp);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function ambil_nama($no_ktp_sales){
        $this->db->select('Nama');
        $this->db->from('sales');
        $this->db->where('No_ktp', $no_ktp_sales);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }   
}
?>