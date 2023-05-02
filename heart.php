<?php

if(isset($_POST["submit"])){
    $db = mysqli_connect("localhost","root","","heart");

    $age = $_POST["age"];
    $chol = $_POST["chol"];
    $fbs = $_POST["fbs"];

    $sql = mysqli_query($db, "INSERT INTO dataset (age, chol, fbs) VALUES ('$age', '$chol', '$fbs')") or die(mysqli_error());
}

//Contoh data pelatihan
$training_data = array(
    array("Berang-berang", "Hitam", "Kecil", "Tidak"),
    array("Berang-berang", "Putih", "Sedang", "Tidak"),
    array("Berang-berang", "Coklat", "Besar", "Tidak"),
    array("Beaver", "Coklat", "Besar", "Tidak"),
    array("Beaver", "Coklat", "Besar", "Tidak"),
    array("Beaver", "Hitam", "Besar", "Ya"),
    array("Berang-berang", "Putih", "Sedang", "Ya"),
    array("Berang-berang", "Coklat", "Kecil", "Ya"),
    array("Beaver", "Putih", "Kecil", "Ya"),
    array("Berang-berang", "Putih", "Besar", "Ya")
);

// Contoh data pengujian
$testing_data = array("Berang-berang", "Hitam", "Sedang");

// Fungsi untuk menghitung probabilitas
function calculateProbability($arr, $item, $class)
{
    $count = 0;
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i][count($arr[$i]) - 1] == $class && $arr[$i][array_search($item, $arr[$i])] == $item) {
            $count++;
        }
    }
    return ($count + 1) / (count($arr) + 2);
}

// Menghitung probabilitas kelas
function calculateClassProb($arr, $class)
{
    $count = 0;
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i][count($arr[$i]) - 1] == $class) {
            $count++;
        }
    }
    return $count / count($arr);
}

// Fungsi untuk melakukan prediksi
function predictClass($training_data, $testing_data)
{
    $classes = array("Ya", "Tidak");
    $result = array();
    for ($i = 0; $i < count($classes); $i++) {
        $class = $classes[$i];
        $prob = 1;
        for ($j = 0; $j < count($testing_data); $j++) {
            $prob *= calculateProbability($training_data, $testing_data[$j], $class);
        }
        $prob *= calculateClassProb($training_data, $class);
        $result[$class] = $prob;
    }
    return array_keys($result, max($result))[0];
}

// Prediksi kelas untuk data pengujian
$predicted_class = predictClass($training_data, $testing_data);
echo "Prediksi kelas untuk data pengujian: " . $predicted_class;