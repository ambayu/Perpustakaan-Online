<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>

    <?php
$dataPoints = array(

);
$i = 0;
foreach ($diagram as $d) {

    $dataPoints[$i] = [
        "y" => (int) $d['bo'], "label" => $d['nama_folder'],
    ];
    $i++;
}

?>

    <script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Diagram Jumlah Buku diFolder"
            },
            axisY: {
                title: "Banyak Buku (di folder)"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## tonnes",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
    </script>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>
</div>
</div>
</div>
<!-- /.container-fluid -->