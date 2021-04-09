<?php 
class Model_produk extends CI_Model
{

public function ambil_data_jumlah_hari_kerja($tgl_awal,$tgl_akhir){
        $this->db->select('No_pemesanan');
        $this->db->from('pemesanan_produk');
        $this->db->like('status','setujui');
        $this->db->or_like('status','Setoran kurang');
        $this->db->or_like('status','selesai');
        $this->db->where('tgl_pemesanan >', $tgl_awal);
        $this->db->where('tgl_pemesanan <', $tgl_akhir);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->order_by('tgl_pemesanan', 'DESC');
            $this->db->order_by('waktu', 'DESC');
            return $query->result();
        } else {
            return false;
        }
}

public function ambil_data_jumlah_pemesanan_produk($tgl_awal,$tgl_akhir){
        $this->db->select_sum('jumlah');
        $this->db->from('pemesanan_produk');
        $this->db->like('status','setujui');
        $this->db->or_like('status','Setoran kurang');
        $this->db->or_like('status','selesai');
        $this->db->where('tgl_pemesanan >', $tgl_awal);
        $this->db->where('tgl_pemesanan <', $tgl_akhir);
        $query = $this->db->get();
        if ($query->result() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function searchproduk($query){
        $this->db->select('*');
        $this->db->from('produk');
        if ($query != '') {
            $this->db->like('produk.Nama', $query);
            $this->db->or_like('produk.keterangan', $query); 
        }
        return $this->db->get();
        
    }
    public function riwayat_permintaan($query){
        $this->db->select('*');
        $this->db->from('pemesanan_produk');
        if ($query != '') {
            $this->db->like('pemesanan_produk.Nama_sales',$query);
            $this->db->or_like('pemesanan_produk.Nama_produk',$query);
            $this->db->or_like('pemesanan_produk.jumlah',$query);
            $this->db->or_like('pemesanan_produk.tgl_pemesanan',$query);
            $this->db->or_like('pemesanan_produk.tgl_pemasaran',$query);
            $this->db->or_like('pemesanan_produk.setoran',$query);
            $this->db->or_like('pemesanan_produk.status',$query);
        }
        return $this->db->get();
    }
    public function search_pemilik_produk($query){
        $this->db->select('*');
        $this->db->from('produk');
        if ($query != '') {
            $this->db->like('produk.Nama', $query);
            $this->db->or_like('produk.keterangan', $query);
            $this->db->or_like('produk.Harga_satuan', $query); 
            $this->db->or_like('produk.potongan_bbm', $query);  
        }
        return $this->db->get();
        
    }
    public function ambildata_harga($no_produk){
        $this->db->select('No_ktp_pemilik,Nama,Harga_satuan,potongan_bbm');
        $this->db->from('produk');
        $this->db->where('No_produk',$no_produk);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function ambil_pemilik_produk(){
        $this->db->select('*');
        $this->db->from('produk');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function pemesanan(){
        $this->db->select('*');
        $this->db->from('pemesanan_produk');
        $this->db->where('status', 'diproses');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->order_by('tgl_pemesanan', 'DESC');
            $this->db->order_by('waktu', 'DESC');
            return $query->result();
        } else {
            return false;
        }
    }
    public function searchpermintaan($query){
        $this->db->select('*');
        $this->db->from('pemesanan_produk');
        if( $query !=''){
            $this->db->like('pemesanan_produk.Nama_sales',$query);
            $this->db->where('status', 'diproses');
            $this->db->or_like('pemesanan_produk.Nama_produk',$query);
            $this->db->where('status', 'diproses');
            $this->db->or_like('pemesanan_produk.jumlah',$query);
            $this->db->where('status', 'diproses');
            $this->db->or_like('pemesanan_produk.tgl_pemesanan',$query);
            $this->db->where('status', 'diproses');
            $this->db->or_like('pemesanan_produk.tgl_pemasaran',$query);
            $this->db->where('status', 'diproses');
            $this->db->or_like('pemesanan_produk.waktu',$query);
            $this->db->where('status', 'diproses');
            $this->db->or_like('pemesanan_produk.status',$query);
            $this->db->where('status', 'diproses');
        }
        return $this->db->get();
    }
    public function buat_produk($bahan_baku,$noktp,$nama_produk,$harga, $ket,$potongan,$nama_gambar_baru){
        $this->db->trans_begin();
 
        $data = array(
            'No_bahan_baku'=>$bahan_baku,
            'No_ktp_pemilik' => $noktp,
            'Nama'      => $nama_produk,
            'Harga_satuan'   => $harga,
            'keterangan'     => $ket,
            'potongan_bbm'   => $potongan,
            'gambar'    => $nama_gambar_baru
        );
        $this->db->insert('produk', $data);

        if ($this->db->trans_status() === FALSE) {
            // rollback transaction when something gone wrong
            $this->db->trans_rollback();
        } else {
            // commit when everything is okay, asooy
            $this->db->trans_commit();
        }
    }
    public function hapus_produk($No_produk){
        $this->db->where('No_produk', $No_produk);
        $this->db->delete('produk');
    }
    public function konfirmasi_pembayaran($No_pemesanan){
        $data = array(
            'status' => 'selesai'
        );
        $this->db->where('No_pemesanan', $No_pemesanan);
        $this->db->update('pemesanan_produk', $data);
    }
    public function setoran_kurang($no_pemesanan,$setoran_yang_dibayar,$setoran_kurang){
        $data = array(
            'setoran_yang_dibayar' => $setoran_yang_dibayar,
            'kekurangan_setoran' => $setoran_kurang,
            'status' => 'Setoran kurang'
        );
        $this->db->where('No_pemesanan', $no_pemesanan);
        $this->db->update('pemesanan_produk', $data);
    }
    public function tolak_pemesanan_produk($No_pemesanan,$keterangan_penolakan){
        $data = array(
            'keterangan'=>$keterangan_penolakan,
            'status' => 'ditolak'
        );
        $this->db->where('No_pemesanan', $No_pemesanan);
        $this->db->update('pemesanan_produk', $data);
    }
    public function ambil_gambar_awal($no_produk){
        $this->db->select('gambar');
        $this->db->from('produk');
        $this->db->where('No_produk', $no_produk);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function ambil_data($No_pemesanan){
        $this->db->select('berat,isi,No_bahan_baku_ukm');
        $this->db->from('bahan_baku_ukm');
        $this->db->join('produk', 'produk.No_bahan_baku = bahan_baku_ukm.No_bahan_baku_ukm', 'INNER');
        $this->db->join('pemesanan_produk', 'pemesanan_produk.No_produk = produk.No_produk', 'INNER');
        $this->db->where('pemesanan_produk.No_pemesanan', $No_pemesanan);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function ubah_status_pemesanan($No_pemesanan){
        $data = array(
            'status' => 'setujui'
        );
        $this->db->where('No_pemesanan', $No_pemesanan);
        $this->db->update('pemesanan_produk', $data);  
    }
    public function edit_produk($no_produk,$nama_produk,$harga_produk, $ket_produk,$potongan,$nama_gambar_baru){
        $data = array(
            'Nama' => $nama_produk,
            'Harga_satuan'=>$harga_produk,
            'keterangan'=>$ket_produk,
            'potongan_bbm'=>$potongan,
            'gambar'=>$nama_gambar_baru
        );
        $this->db->where('No_produk', $no_produk);
        $this->db->update('produk', $data);
    }
    public function simpan_p_produk($no_ktp_sales,$ktp_pemilik,$no_produk,$nama_produk,$jumlah,$tgl_pemesanan,$tgl_pemasaran,$nama_sales,$waktu,$setoran){
        $this->db->trans_begin();
        $data = array(
            'No_ktp_pemilik' => $ktp_pemilik,
            'No_ktp_sales' => $no_ktp_sales,
            'No_produk' => $no_produk,
            'Nama_produk'      => $nama_produk,
            'Nama_sales'   => $nama_sales,
            'waktu'     => $waktu,
            'tgl_pemesanan'   => $tgl_pemesanan,
            'tgl_pemasaran' =>$tgl_pemasaran,
            'jumlah' => $jumlah,
            'setoran'=> $setoran,
            'status' => 'diproses'
        );
        $this->db->insert('pemesanan_produk', $data);

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