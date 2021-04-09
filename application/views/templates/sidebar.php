<?php if ($this->session->userdata('level') == 'sales') : ?>
    <div id="leftsidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn mt-3" onclick="closeNav()">&times;</a>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>sales_home">
                <i class="fa fa-fw fa-home mr-3"></i>
                Dashboard
            </a>
        </li>
        <li class="item-header">produk</li>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>pesan_produk">
                <i class=""></i>
                Pesan Produk
            </a>
        </li>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>lihat_r_pemesanan">
                <i></i>
                Lihat Riwayat Pemesanan
            </a>
        </li>
        <li class="item-header">Tunjangan Hari Raya</li>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>lihat_thr">
                <i></i>
                Lihat Tujangan Hari Raya
            </a>
        </li>
        <li class="item-header">Profile</li>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>lihat_profile">
                <i></i>
                Lihat Profile
            </a>
        </li>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>logout">
                <i"></i>
                Logout
            </a>
        </li>
    </div>
<?php elseif ($this->session->userdata('level') == 'supplier') : ?>
    <div id="leftsidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn mt-3" onclick="closeNav()">&times;</a>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>supplier_home">
                <i class="fa fa-fw fa-home mr-3"></i>
                Dashboard
            </a>
        </li>
        <li class="item-header">Bahan Baku</li>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>supplier_permintaan_bahan_baku">
                Daftar Permintaan Bahan Baku
            </a>
        </li>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>supplier_daftar_bahan_baku">
                Daftar Bahan Baku
            </a>
        </li>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>supplier_buat_bahan_baku">
                Buat Bahan Baku
            </a>
        </li>
        <li class="item-header">Profile</li>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>supplier_lihat_profile">
                 Lihat Profile
            </a>
        </li>
        <li class="item-link">
            <a href="<?php echo base_url(); ?>logout">
                Logout
            </a>
        </li>
    </div>
<?php endif; ?>