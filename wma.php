<div class="page-header">
    <h1>Perhitungan Weigted Moving Average</h1>
</div>
<?php

$success = false;
if ($_POST) {
    $next_periode = $_POST['next_periode'];
    $n_periode = $_POST['n_periode'];
    $count = $db->get_var("SELECT COUNT(*) FROM tb_periode");

    if ($n_periode < 2 || $n_periode > $count) {
        print_msg("Isikan periode moving antara 2 dan $count");
    } elseif ($next_periode < 1) {
        print_msg('Masukkan periode peramalan minimal 1');
    } else {
        $success = true;
    }
}
?>
<form method="post">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Masukkan periode</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Manajemen Data<span class="text-danger">*</span></label>
                        <select class="form-control" name="kode_jenis">
                            <?= get_jenis_option(set_value('kode_jenis')) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Periode Moving<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="n_periode" value="<?= set_value('n_periode', 3) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Jumlah Periode Diramal<span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="next_periode" value="<?= set_value('next_periode', 1) ?>" />
                    </div>
                    <button class="btn btn-primary"><span class="glyphicon glyphicon-signal"></span> Hitung</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
$c = $db->get_results("SELECT * FROM tb_relasi WHERE nilai < 0");
if (!$PERIODE || !$JENIS) :
    echo "Tampaknya anda belum mengatur periode dan jenis. Silahkan tambahkan minimal 3 periode dan 3 jenis.";
elseif ($c) :
    echo "Tampaknya anda belum mengatur nilai periode. Silahkan atur pada menu <strong>Nilai Periode</strong>.";
elseif ($success) :
    include 'wma_hasil.php';
    $_SESSION['post'] = $_POST;
endif ?>