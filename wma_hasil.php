<?php
$_SESSION['post'] = $_POST;
$analisa = get_analisa();
$kode_jenis = $_POST['kode_jenis'];
$analisa = $analisa[$kode_jenis];

$wma = new WeightedMovingAverage($analisa, $next_periode, $n_periode);
$categories = array();
$series = array();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $JENIS[$kode_jenis] ?></h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Bulan(n)</th>
                    <th>Y</th>
                    <th>Fx</th>
                    <th>e<sub>t</sub></th>
                    <th>|e<sub>t</sub>|</th>
                    <th>|e<sub>t</sub> / y<sub>t</sub>|</th>
                </tr>
            </thead>
            <?php foreach ($analisa as $key => $val) :
                $categories[date('M-Y', strtotime($key))] = date('M-Y', strtotime($key));
                $series['aktual']['data'][$key] = $val * 1;
                $series['prediksi']['data'][$key] = round($wma->ft[$key], 2); ?>
                <tr>
                    <td><?= date('M-Y', strtotime($key)) ?></td>
                    <td><?= number_format($val) ?></td>
                    <td><?= number_format($wma->ft[$key], 2) ?></td>
                    <td><?= !isset($wma->et[$key]) ? '' : number_format($wma->et[$key], 2) ?></td>
                    <td><?= !isset($wma->et_abs[$key]) ? '' : number_format($wma->et_abs[$key], 2) ?></td>
                    <td><?= !isset($wma->et_yt[$key]) ? '' : number_format($wma->et_yt[$key], 2) ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="3" class="text-right">MAPE (Mean Absolute Percentage Error)</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?= number_format($wma->error['MAPE'], 2) ?> % </td>
            </tr>
        </table>
    </div>


<table>
    <?php 
        if($wma->error['MAPE'] <= 10){
	        echo "<strong> 1. < 10% = sangat akurat </strong>
           <br> 2. 10-20% = baik
           <br> 3. 20-30% = wajar
           <br> 4. >40% = tidak akurat";
        }elseif($wma->error['MAPE'] >= 10 && $wma->error['MAPE'] <= 20 ){
            echo "1. < 10% = sangat akurat
            <br><strong> 2. 10-20% = baik </strong>
            <br> 3. 20-30% = wajar
            <br> 4. >40% = tidak akurat";
        }elseif($wma->error['MAPE'] >= 21 && $wma->error['MAPE'] <= 30 ){
	        echo "1. < 10% = sangat akurat
            <br> 2. 10-20% = baik
            <br><strong> 3. 20-30% = wajar </strong>
            <br> 4. >40% = tidak akurat";
        }
        else{
	        echo "Analisa Data Kembali
            <br> 1. < 10% = sangat akurat
            <br> 2. 10-20% = baik
            <br> 3. 20-30% = wajar
            <br><strong>4. >40% = tidak akurat <br> (Diharapkan Analisa Data Kembali)</strong>";
             }
    ?>
</table>


</div>

    <div class="panel-body">
        Hasil Prediksi:
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Bulan (n)</th>
                    <th>Fx</th>
                </tr>
            </thead>
            <?php foreach ($wma->next_ft as $key => $val) :
                $key = date('M-Y', strtotime($key));
                $categories[$key] = $key;
                $series['aktual']['data'][$key] = null;
                $series['prediksi']['data'][$key] = round($val, 2); ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= number_format($val) ?></td>
                </tr>
            <?php endforeach ?>
        </table>

        <table>
    <?php 
        if(number_format($val) <= 5033807){
	        echo "Hasil Ramalan Lebih Kecil dari Rp. 5.033.807
                <br> 1. Mengevaluasi supply dan demand yang terjadi dimasyarakat.
                <br> 2.Melakukan kerja sama dengan supplier untuk menjual produk-produk yang bisa diberikan diskon. 
                <br> 3. Meningkatkan pangsa pasar dengan menjual secara daring.
                <br> 4.	Menerapkan pengurangan harga pada beberapa produk yang sukar dibeli oleh masyarakat.
                <br> 5.	Membuat brosur detail produk dengan berbagai macam promo yang menarik." ;
        }else{
	        echo "Hasil Ramalan Lebih Besar dari Rp. 5.033.807
            <br> 1. Meningkatkan kinerja karyawan.
            <br> 2.	Melakukan managing cost.
            <br> 3.	Memberikan pelayanan yang baik untuk pelanggan.
            <br> 4.	Menambah kuantitas produk.
            <br> 5.	Memperluas jaringan penjualan.
            <br> 6.	Menerapkan sistem pengantaran ke alamat dengan belanja minimum Rp.500.000 dengan maximal jarak 20 km.";
             }
    ?>
</table>


    </div>
    <div class="panel-body">
        <div id="container"></div>
        <script>
            <?php
            $categories = array_values($categories);
            $series['aktual']['name'] = 'Aktual';
            $series['prediksi']['name'] = 'Prediksi';
            $series['aktual']['data'] = array_values($series['aktual']['data']);
            $series['prediksi']['data'] = array_values($series['prediksi']['data']);
            $series = array_values($series);
            ?>
            Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Grafik Data dan Hasil Prediksi ' + '<?= $JENIS[$kode_jenis] ?>'
                },
                xAxis: {
                    categories: <?= json_encode($categories) ?>
                },
                yAxis: {
                    title: {
                        text: 'Total'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: <?= json_encode($series) ?>
            });
        </script>
    </div>
</div>
