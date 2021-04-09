<?php 
class Model_keuangan extends CI_Model
{

    public function total_pendapatan($tgl_awal,$tgl_akhir){
        $this->db->select_sum('setoran');
        $this->db->from('pemesanan_produk');
        $this->db->like('status','setujui');
        $this->db->or_like('status','Setoran kurang');
        $this->db->or_like('status','selesai');
        $this->db->where('tgl_pemesanan >', $tgl_awal);
        $this->db->where('tgl_pemesanan <', $tgl_akhir);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
   
    }
    public function total_pengeluaran($tgl_awal,$tgl_akhir){
        $this->db->select_sum('harga_total');
        $this->db->from('pemesanan_bahan_baku');
        $this->db->like('status','setujui');
        $this->db->or_like('status','diterima');
        $this->db->where('tgl_dipesan >', $tgl_awal);
        $this->db->where('tgl_dipesan <', $tgl_akhir);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

     public function ambil_data_pengeluaran($tgl_awal,$tgl_akhir){
        $this->db->select('*');
        $this->db->from('pemesanan_bahan_baku');
        $this->db->like('status','setujui');
        $this->db->like('status','setujui');
        $this->db->or_like('status','diterima');
        $this->db->where('tgl_dipesan >', $tgl_awal);
        $this->db->where('tgl_dipesan <', $tgl_akhir);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function ambil_data_pendapatan($tgl_awal,$tgl_akhir){
        $this->db->select('*');
        $this->db->from('pemesanan_produk');
        $this->db->like('status','setujui');
        $this->db->or_like('status','Setoran kurang');
        $this->db->or_like('status','selesai');
        $this->db->where('tgl_pemesanan >', $tgl_awal);
        $this->db->where('tgl_pemesanan <', $tgl_akhir);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
?>