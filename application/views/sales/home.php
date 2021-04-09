<div id="main">
    <div class="card col-md-12 shadow md-5 mb-30 p-3 bg-white rounded mt-auto">
        <div class="card-body">
            <h3 class="card-title mb-30">Riwayat Pemesanan</h3>

            <div class="table-responsive-md">
                <table class="table">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Waktu</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Tanggal Pemasaran</th>
                        <th>Setoran</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    <tr>
                    <?php if ($pemesanan !== FALSE) : ?>
                        <?php foreach ($pemesanan as $data) : ?>
                        <tr>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p><?php echo $data->Nama_produk; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p><?php echo $data->jumlah; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p><?php echo $data->waktu; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p><?php echo $data->tgl_pemesanan; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p><?php echo $data->tgl_pemasaran; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p><?php echo $data->setoran; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p><?php echo $data->status; ?></p>
                                    </div>
                                </div>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php elseif ($pemesanan === FALSE) : ?>
                        <tr>
                            <td ng-repeat="col in columns" class="ng-scope" colspan="6">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p class="text-danger p-3 text-center"><?php echo "Belum ada Riwayat Pemesanan" ?></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php  endif; ?>
                    </tr>
                </table>
            </div>

            <a href="<?php echo base_url(); ?>sales/lihat_r_pemesanan">Lihat selengkapnya</a>
        </div>
    </div>
</div>
        