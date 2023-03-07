<?php
$_POST = $_SESSION['post'];

$next_periode = $_POST['next_periode'];
$n_periode = $_POST['n_periode'];
$kode_jenis = $_POST['kode_jenis'];
$analisa = get_analisa();
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
                    <th>Tahun (n)</th>
                    <th>Y</th>
                    <th>Fx</th>
                    <th>e<sub>t</sub></th>
                    <th>e<sub>t</sub><sup>2</sup></th>
                    <th>|e<sub>t</sub>|</th>
                    <th>|e<sub>t</sub> / y<sub>t</sub>|</th>
                </tr>
            </thead>
            <?php foreach ($analisa as $key => $val) :
                $categories[$key] = $key;
                $series['aktual']['data'][$key] = $val * 1;
                $series['prediksi']['data'][$key] = round($wma->ft[$key], 2); ?>
                <tr>
                    <td><?= date('M-Y', strtotime($key)) ?></td>
                    <td><?= number_format($val) ?></td>
                    <td><?= number_format($wma->ft[$key], 2) ?></td>
                    <td><?= !isset($wma->et[$key]) ? '' : number_format($wma->et[$key], 2) ?></td>
                    <td><?= !isset($wma->et_square[$key]) ? '' : number_format($wma->et_square[$key], 2) ?></td>
                    <td><?= !isset($wma->et_abs[$key]) ? '' : number_format($wma->et_abs[$key], 2) ?></td>
                    <td><?= !isset($wma->et_yt[$key]) ? '' : number_format($wma->et_yt[$key], 2) ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="4" class="text-right">MAPE (Mean Absolute Percentage Error)</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?= number_format($wma->error['MAPE'], 2) ?> % </td>
            </tr>
        </table>
    </div>
    <div class="panel-body">
        Hasil Prediksi:
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tahun (n)</th>
                    <th>Fx</th>
                </tr>
            </thead>
            <?php foreach ($wma->next_ft as $key => $val) :
                $categories[$key] = $key;
                $series['aktual']['data'][$key] = null;
                $series['prediksi']['data'][$key] = round($val, 2); ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= number_format($val) ?></td>
                </tr>
            <?php endforeach ?>
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
                // subtitle: {
                //     text: 'Source: WorldClimate.com'
                // },
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