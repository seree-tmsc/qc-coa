<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pChart_QcResult_View</title>
    <link rel="stylesheet" href="../vendors/bootstrap-3.3.7-dist/css/bootstrap.css">
    <script src="../vendors/jquery-3.2.1/jquery-3.2.1.js"></script>
    <script src="../vendors/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    <script src="../vendors/Chart.js/Chart.min.js"></script>
    <script src="../vendors/Chart.js/Chart.bundle.min.js"></script>
</head>
<body>
    <?php 
    require_once('createDataset.php');

    if($aMax[0] == 'N/A')
    {
        echo "<script> alert('Cannot show chart becuase this inspection item not numeric type...'); window.close(); </script>";
        exit;
    }
    else
    {
    ?>
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <canvas id="myChart1" style="background-color:WhiteSmoke ; border:3px solid navy;"></canvas>
            </div>
        </div>
        <!--
        <div class="row">
            <div class="col-md-12" style='background-color:green;'>
                <canvas id="myChart3" height='200' style="border:1px solid #000000;"></canvas>
            </div>
        </div>
        -->
    </div>
    <script>
        var ctx = document.getElementById('myChart1').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($aSeries1);?>,
                datasets: [
                    /* ----------- */
                    /* DATA RESULT */
                    /* ----------- */
                    {                    
                        fill: false,
                        label: <?php echo "'".$_POST['inspItem-ddl'] ."'"; ?>,
                        //borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'red',                        
                        pointRadius: 5,
                        pointHoverRadius: 10,
                        pointStyle: 'crossRot',
                        data: <?php echo json_encode($aData1);?>,
                        lineTension: 0,
                    },
                    /* --------- */
                    /* MAX VALUE */
                    /* --------- */
                    {
                        fill: false,
                        label: "MAX",
                        backgroundColor: 'blue',
                        borderColor: 'blue',
                        borderDash: [5, 1],
                        pointRadius: 3,
                        pointHoverRadius: 1,
                        pointStyle: 'circle',
                        data: <?php echo json_encode($aMax);?>
                    },
                    /* --------- */
                    /* MIN VALUE */
                    /* --------- */
                    {
                        fill: false,
                        label: "MIN",
                        backgroundColor: 'cyan',
                        borderColor: 'cyan',
                        borderDash: [5, 1],
                        pointRadius: 3,
                        pointHoverRadius: 1,
                        pointStyle: 'circle',
                        data: <?php echo json_encode($aMin);?>
                    }
                ]
            },
            options: {
                //scales: {yAxes:[{ticks:{min: 0, max: 0.5, stepSize: 0.1}}]},
                //legend: {display: false},
                                
                responsive: true,
                tooltips: {mode: 'single',},
                scales: {
                    xAxes: [{
                        display: true, 
                        gridLines: {
                            display: true,
                            //color: 'green',
                        },
                        ticks: {fontColor: 'navy',},
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: {
                            display: true,
                            //color: 'green',
                        },
                        ticks: {fontColor: 'navy',},
                    }],
                },                
            }
        });
    </script>
<?php
    }
?>
</body>
</html>