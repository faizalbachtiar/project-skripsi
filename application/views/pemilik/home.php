<section class="section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner_content text-center">
                        <h2 class="text-uppercase mt-4 mb-5">
                            UKM Krupuk 
                        </h2>
                        <h2 class="text-uppercase mt-4 mb-5">
                            Jaya 
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card col-md-12 mb-30 mt-20 shadow p-3 bg-white rounded">
                <div class="card-body">
                    <h3 class="card-title title_color mb-30">Data Pemesanan Produk Terbaru</h3>
                    <div class="table-responsive-md mb-30">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Sales</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Waktu</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Pemasaran</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <?php if ($pemesanan !== FALSE) : ?>
                        <?php foreach ($pemesanan as $data) : ?>
                            <tr>
                                <td ng-repeat="col in columns" class="ng-scope">
                                    <div ng-switch="" on="col.renderType">
                                        <div ng-switch-when="primaryLink" class="ng-scope">
                                            <p><?php echo $data->Nama_sales; ?></p>
                                        </div>
                                    </div>
                                </td>
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
                                            <p><?php echo $data->status; ?></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                <?php endif; ?>
                <?php if ($pemesanan == FALSE) : ?>
                            <td ng-repeat="col in columns" class="ng-scope" colspan="6">
                                    <div ng-switch="" on="col.renderType">
                                        <div ng-switch-when="primaryLink" class="ng-scope">
                                        <br>
                                            <p class="text-center text-danger">Belum ada pemesanan produk terbaru</p>
                                        </div>
                                    </div>
                                </td>
                <?php endif; ?>
                </table>
                <a href="<?php echo base_url(); ?>permintaan_sales">Lihat selengkapnya</a>
                </div>
            </div>
    </section>