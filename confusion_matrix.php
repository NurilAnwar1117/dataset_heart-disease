<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confusion_matrix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="j.css">
    <script src="p.js"></script>
    <style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  

}



.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>
<div class="topnav">
  <a class="active" href="dataset.php"><i class="fa fa-fw fa-home"></i> Home</a>
  <a  href="b/index.php"><i class="fa fa-fw fa-search"></i> Dataset</a>
  <a  href="confusion_matrix.php"><i class="fa fa-fw fa-envelope"></i> Confusion-matrix</a>
</div>
<div class="isi">
<?php
$db = mysqli_connect("localhost", "root", "", "heart");

//query untuk mengambil data dari tabel
$query = "SELECT * FROM dataset WHERE dataset_id < 101";
$result = mysqli_query($db, $query);

$predict = "SELECT * FROM predict WHERE predict_id < 101";
$rs = mysqli_query($db, $predict);

//menyimpan data dalam array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
$data[] = $row;
}

$dt = array();
while ($row = mysqli_fetch_assoc($rs)) {
$dt[] = $row;
}

// Data kelas aktual
$actual = array();
foreach($data as $i){
    $actual[] = $i['output'];
}

// print_r($actual);

// Data kelas prediksi
$predicted_K = array();
$predicted_B = array();
foreach($dt as $i){
    $predicted_K[] = $i['k-means'];
    $predicted_B[] = $i['Bayes'];
}

// print_r($predicted_K);
// print_r($predicted_B);


// Menghitung true positives (TP), false positives (FP), true negatives (TN), dan false negatives (FN)
$tp_k = $fp_k = $tn_k = $fn_k = 0;
for ($i = 0; $i < count($actual); $i++) {
    if ($actual[$i] == 1 && $predicted_K[$i] == 1) {
        $tp_k++;
    } elseif ($actual[$i] == 0 && $predicted_K[$i] == 1) {
        $fp_k++;
    } elseif ($actual[$i] == 0 && $predicted_k[$i] == 0) {
        $tn_k++;
    } elseif ($actual[$i] == 1 && $predicted_K[$i] == 0) {
        $fn_k++;
    }
}

// Menghitung presisi, recall, dan akurasi
$precision_k = $tp_k / ($tp_k + $fp_k);
$recall_k = $tp_k / ($tp_k + $fn_k);
$accuracy_k = ($tp_k + $tn_k) / count($actual);

// Menampilkan hasil
echo "Presisi K-Means: " . $precision_k . "\n";
echo "Recall K-Means: " . $recall_k . "\n";
echo "Akurasi K-Means: " . $accuracy_k . "<br>";

// Menghitung true positives (TP), false positives (FP), true negatives (TN), dan false negatives (FN)
$tp_B = $fp_B = $tn_B = $fn_B = 0;
for ($i = 0; $i < count($actual); $i++) {
    if ($actual[$i] == 1 && $predicted_B[$i] == 1) {
        $tp_B++;
    } elseif ($actual[$i] == 0 && $predicted_B[$i] == 1) {
        $fp_B++;
    } elseif ($actual[$i] == 0 && $predicted_B[$i] == 0) {
        $tn_B++;
    } elseif ($actual[$i] == 1 && $predicted_B[$i] == 0) {
        $fn_B++;
    }
}

// Menghitung presisi, recall, dan akurasi
$precision_B = $tp_B / ($tp_B + $fp_B);
$recall_B = $tp_B / ($tp_B + $fn_B);
$accuracy_B = ($tp_B + $tn_B) / count($actual);

// Menampilkan hasil
echo "Presisi Bayes: " . $precision_B . "\n";
echo "Recall Bayes: " . $recall_B . "\n";
echo "Akurasi Bayes: " . $accuracy_B . "\n";
?>
</div>
</body>
</html>