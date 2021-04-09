<?php 
class Model_bahan_baku extends CI_Model
{
    public function hapus_b_baku($No_bahan_baku){
        $this->db->where('No_bahan_baku', $No_bahan_baku);
        $this->db->delete('bahan_baku');
    }
    public function bahan_baku_supplier($query,$noktp){
        $this->db->select('*');
        $this->db->from('bahan_baku');
        $this->db->where('No_ktp_supplier',$noktp);
        if ($query != '') {
            $this->db->like('bahan_baku.Nama', $query);
            $this->db->where('No_ktp_supplier',$noktp);
            $this->db->or_like('bahan_baku.Harga', $query); 
            $this->db->where('No_ktp_supplier',$noktp);
            $this->db->or_like('bahan_baku.isi', $query);
            $this->db->where('No_ktp_supplier',$noktp);
        }
        return $this->db->get();
    }
    public function permintaan_b_baku($query,$noktp){
        $this->db->select('*');
        $this->db->from('pemesanan_bahan_baku');
        $this->db->where('No_ktp_supplier',$noktp);
        if ($query != '') {
            $this->db->like('pemesanan_bahan_baku.Nama_bahan_baku', $query);
            $this->db->where('No_ktp_supplier',$noktp);
            $this->db->or_like('pemesanan_bahan_baku.Berat', $query); 
            $this->db->where('No_ktp_supplier',$noktp);
            $this->db->or_like('pemesanan_bahan_baku.tgl_dipesan', $query);
            $this->db->where('No_ktp_supplier',$noktp);
            $this->db->or_like('pemesanan_bahan_baku.status', $query);
            $this->db->where('No_ktp_supplier',$noktp);  
        }
        return $this->db->get();
         
    }
    public function search_bahan_baku($query){
        $this->db->select('*');
        $this->db->from('bahan_baku_ukm');
        if ($query != '') {
            $this->db->like('bahan_baku_ukm.Nama', $query);
            $this->db->or_like('bahan_baku_ukm.berat', $query); 
            $this->db->or_like('bahan_baku_ukm.isi', $query); 
        }
        return $this->db->get();
        
    }
    public function search_pemesanan_bahan_baku($query){
        $this->db->select('*');
        $this->db->from('pemesanan_bahan_baku');
        $this->db->join('bahan_baku', 'bahan_baku.No_bahan_baku = pemesanan_bahan_baku.No_bahan_baku', 'INNER');
        if ($query != '') {
            $this->db->like('pemesanan_bahan_baku.Nama_supplier', $query);
            $this->db->or_like('pemesanan_bahan_baku.Nama_bahan_baku', $query); 
            $this->db->or_like('pemesanan_bahan_baku.Berat', $query);  
            $this->db->or_like('bahan_baku.isi', $query);  
            $this->db->or_like('pemesanan_bahan_baku.tgl_pengiriman', $query); 
            $this->db->or_like('pemesanan_bahan_baku.status', $query); 
            $this->db->or_like('pemesanan_bahan_baku.harga_total', $query); 
        }
        return $this->db->get();
    }
    
    public function pesan_bahan_baku($noktp,$no_ktp_supplier,$no_bahan_baku,$data_supplier,$data_bahan_baku,$berat,$tgl_dipesan,$data_harga_total){
        $this->db->trans_begin();
        $data = array(
            'No_ktp_pemilik' => $noktp,
            'No_ktp_supplier' => $no_ktp_supplier,
            'No_bahan_baku'   => $no_bahan_baku,
            'Nama_supplier'   => $data_supplier,
            'Nama_bahan_baku'=> $data_bahan_baku,
            'Berat'=> $berat,
            'tgl_dipesan'=>$tgl_dipesan,
            'harga_total'=>$data_harga_total,
            'status'=>'diproses'
           
        );
        $this->db->insert('pemesanan_bahan_baku', $data);

        if ($this->db->trans_status() === FALSE) {
            // rollback transaction when something gone wrong
            $this->db->trans_rollback();
        } else {
            // commit when everything is okay, asooy
            $this->db->trans_commit();
        }
    }
    public function cek_bahan_baku_ukm($No_bahan_baku){
        $this->db->select('*');
        $this->db->from('bahan_baku_ukm');
        $this->db->where('No_bahan_baku', $No_bahan_baku);
        $this->db->limit(1);
        $result = $this->db->get();
         if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }
    public function ambil_data_pemesanan_bahan_baku($No_pemesanan_bahan_baku){
        $this->db->select('*');
        $this->db->from('pemesanan_bahan_baku');
        $this->db->where('No_pemesanan_bahan_baku', $No_pemesanan_bahan_baku);
        $this->db->limit(1);
        $result = $this->db->get();
         if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }
    public function ambil_data_isi($No_bahan_baku){
        $this->db->select('isi');
        $this->db->from('bahan_baku');
        $this->db->where('No_bahan_baku', $No_bahan_baku);
        $this->db->limit(1);
        $result = $this->db->get();
         if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }
    public function tolak_permintaan_b_baku($no_pemesanan_b_baku,$keterangan){
        $data = array(
            'keterangan' => $keterangan,
            'status'=>'tolak'
        );
        $this->db->where('No_pemesanan_bahan_baku', $no_pemesanan_b_baku);
        $this->db->update('pemesanan_bahan_baku', $data);
    }
    public function setujui_permintaan_b_baku($no_pemesanan_b_baku,$tgl_pengiriman){
        $data = array(
            'tgl_pengiriman' => $tgl_pengiriman,
            'status'=>'setujui'
        );
        $this->db->where('No_pemesanan_bahan_baku', $no_pemesanan_b_baku);
        $this->db->update('pemesanan_bahan_baku', $data);
    }
    public function update_b_baku($No_bahan_baku,$berat_akhir,$isi){
        $data = array(
            'berat' => $berat_akhir,
            'isi'=>$isi
        );
        $this->db->where('No_bahan_baku', $No_bahan_baku);
        $this->db->update('bahan_baku_ukm', $data);
    }
    public function edit_bahan_baku($no_bahan_baku_ukm,$nama_bahan_baku,$berat,$isi){
        $data = array(
            'nama' => $nama_bahan_baku,
            'berat'=> $berat,
            'isi'=> $isi
        );
        $this->db->where('No_bahan_baku_ukm', $no_bahan_baku_ukm);
        $this->db->update('bahan_baku_ukm', $data);
    }
    public function edit_bahan_baku_supplier($no_bahan_baku,$nama_bahan_baku,$harga,$isi){
        $data = array(
            'Nama' => $nama_bahan_baku,
            'Harga'=> $harga,
            'isi'=> $isi
        );
        $this->db->where('No_bahan_baku', $no_bahan_baku);
        $this->db->update('bahan_baku', $data);
    }
    public function update_status($No_pemesanan_bahan_baku){
        $data = array(
            'status' => 'diterima'
        );
        $this->db->where('No_pemesanan_bahan_baku', $No_pemesanan_bahan_baku);
        $this->db->update('pemesanan_bahan_baku', $data);
    }
    public function insert_b_baku($No_bahan_baku,$noktp,$nama,$berat,$isi){
        $this->db->trans_begin();
 
        $data = array(
            'No_bahan_baku'  => $No_bahan_baku,
            'No_ktp_pemilik' => $noktp,
            'nama'   => $nama,
            'berat'     => $berat,
            'isi'   => $isi
        );
        $this->db->insert('bahan_baku_ukm', $data);

        if ($this->db->trans_status() === FALSE) {
            // rollback transaction when something gone wrong
            $this->db->trans_rollback();
        } else {
            // commit when everything is okay
            $this->db->trans_commit();
        }
    }
    public function buat_bahan_baku($noktp,$nm_bahan_baku,$Isi,$Harga){
        $this->db->trans_begin();
 
        $data = array(
            'No_ktp_supplier' => $noktp,
            'Nama'   => $nm_bahan_baku,
            'Harga'     => $Harga,
            'isi'   => $Isi
        );
        $this->db->insert('bahan_baku', $data);

        if ($this->db->trans_status() === FALSE) {
            // rollback transaction when something gone wrong
            $this->db->trans_rollback();
        } else {
            // commit when everything is okay
            $this->db->trans_commit();
        }
    }
    public function data_bahan_baku(){
        $this->db->select('*');
        $this->db->from('bahan_baku_ukm');
        $result = $this->db->get();
         if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
    public function update_jumlah_stock($no,$berat_sisa){
        $data = array(
            'berat' => $berat_sisa
        );
        $this->db->where('No_bahan_baku_ukm', $no);
        $this->db->update('bahan_baku_ukm', $data);  
    }
}
?>