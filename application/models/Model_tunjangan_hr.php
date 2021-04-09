<?php 
class Model_tunjangan_hr extends CI_Model
{
    public function search_thr($query){
        $this->db->select('*');
        $this->db->from('tunjangan_hari_raya');
        if ($query != '') {
            $this->db->like('tunjangan_hari_raya.nama_sales', $query);
            $this->db->or_like('tunjangan_hari_raya.tanggal', $query); 
            $this->db->or_like('tunjangan_hari_raya.nilai', $query);
            $this->db->or_like('tunjangan_hari_raya.keterangan', $query);
        }
        return $this->db->get();
        
    }
    public function thr_sales($noktp,$query){
        $this->db->select('*');
        $this->db->from('tunjangan_hari_raya');
        $this->db->where('No_ktp_sales',$noktp);
        if ($query != '') {
            $this->db->like('tunjangan_hari_raya.tanggal', $query);
            $this->db->where('No_ktp_sales',$noktp);
            $this->db->or_like('tunjangan_hari_raya.nilai', $query); 
            $this->db->where('No_ktp_sales',$noktp);
            
        }
        return $this->db->get();
    }
    public function ambil_data($No_ktp_sales){
        $this->db->select('Nama');
        $this->db->from('sales');
        $this->db->where('No_ktp', $No_ktp_sales);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function save_tunjangan($No_ktp_pemilik,$No_ktp_sales,$nama_sales,$tgl, $nilai,$keterangan ){
        $this->db->trans_begin();
        $data = array(
            'No_ktp_pemilik' => $No_ktp_pemilik,
            'No_ktp_sales' => $No_ktp_sales,
            'nama_sales'      => $nama_sales,
            'nilai'   => $nilai,
            'tanggal'     => $tgl,
            'keterangan'=>$keterangan
          );
        $this->db->insert('tunjangan_hari_raya', $data);

        if ($this->db->trans_status() === FALSE) {
            // rollback transaction when something gone wrong
            $this->db->trans_rollback();
        } else {
            // commit when everything is okay
            $this->db->trans_commit();
        }
    }
}
?>