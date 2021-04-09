<?php 
class Model_supplier extends CI_Model
{
    public function ambil_data_supplier(){
        $this->db->select('*');
        $this->db->from('supplier');
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function ambil_bahan_baku($no_ktp_supplier){
        $this->db->select('*');
        $this->db->from('bahan_baku');
        $this->db->where('No_ktp_supplier', $no_ktp_supplier);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }   
    public function ambil_nama($no_ktp_supplier){
        $this->db->select('Nama');
        $this->db->from('supplier');
        $this->db->where('No_ktp', $no_ktp_supplier);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function ambil_data_bahan_baku($no_bahan_baku){
        $this->db->select('Nama');
        $this->db->from('bahan_baku');
        $this->db->where('No_bahan_baku', $no_bahan_baku);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function ambil_data_p_bahan_baku( $noktp){
        $this->db->select('*');
        $this->db->from('pemesanan_bahan_baku');
        $this->db->where('No_ktp_supplier', $noktp);
        $this->db->where('status', 'diproses');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }   
}