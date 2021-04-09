<div id="main">
    <div class="card col-md-12 shadow md-5 mb-30 p-3 bg-white rounded mt-auto">
        <div class="card-body">
            <h3 class="card-title mb-30">Permintaan Bahan Baku Terbaru</h3>

            <div class="table-responsive-md">
                <table class="table">
                    <tr>
                        <th>Nama Bahan Baku</th>
                        <th>Berat</th>
                        <th>Tanggal dipesan</th>
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
                                        <p><?php echo $data->Nama_bahan_baku; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p><?php echo $data->Berat; ?> Kg</p>
                                    </div>
                                </div>
                            </td>
                            <td ng-repeat="col in columns" class="ng-scope">
                                <div ng-switch="" on="col.renderType">
                                    <div ng-switch-when="primaryLink" class="ng-scope">
                                        <p><?php echo $data->tgl_dipesan;?></p>
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
                                        <p class="text-danger p-3 text-center"><?php echo "Belum ada Pemesanan Bahan Baku" ?></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php  endif; ?>
                    </tr>
                </table>
            </div>

            <a href="<?php echo base_url(); ?>supplier_permintaan_bahan_baku">Lihat selengkapnya</a>
        </div>
    </div>
</div>
        