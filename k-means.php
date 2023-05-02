<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <?php
        //koneksi ke database
        $db = mysqli_connect("localhost", "root", "", "heart");

        //query untuk mengambil data dari tabel
        $query = "SELECT * FROM dataset";
        $result = mysqli_query($db, $query);

        //menyimpan data dalam array
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
        }

        //inisialisasi nilai K (jumlah cluster yang diinginkan) dan iterasinya
        $kluster = 3;
        $iterasi = 0;
        $maks_iterasi = 100;
        $centroids = array();

        // inisialisasi centroid awal secara acak
        
        for ($i = 0; $i < $kluster; $i++) {
        $rand_keys = array_rand($data);
        $centroids[] = $data[$rand_keys];
        }

        // print_r($centroids);


        //iterasi algoritma K-means
        while($iterasi < $maks_iterasi ){
            //menghitung jarak antara setiap data dengan centroid
            $jarak = array();
            foreach ($data as $row) {
                $jarak_row = array();
                foreach ($centroids as $centroid) {
                $distance = sqrt(pow($row['age'] - $centroid['age'], 2) + pow($row['chol'] - $centroid['chol'], 2) + pow($row['fbs'] - $centroid['fbs'], 2));
                $jarak_row[] = $distance;
                }
                $jarak[] = $jarak_row;
            }

            // print_r($jarak);  

            //menentukan kluster untuk setiap data berdasarkan jarak terdekat
            $clusters = array_fill(0, $kluster, array());
            foreach ($jarak as $i => $row) {
                $min_jarak = min($row);
                $cluster_index = array_search($min_jarak, $row);
                $clusters[$cluster_index][] = $data[$i];
            }


            //menghitung ulang posisi centroid
            $new_centroids = array();
            foreach ($clusters as $cluster) {
                $cluster_size = count($cluster);
                $age_sum = 0;
                $chol_sum = 0;
                $fbs_sum = 0;
                foreach ($cluster as $data_point) {
                $age_sum += $data_point['age'];
                $chol_sum += $data_point['chol'];
                $fbs_sum += $data_point['fbs'];
                }
                $new_centroids[] = array('age' => $age_sum / $cluster_size, 'chol' => $chol_sum / $cluster_size, 'fbs' => $fbs_sum / $cluster_size);
            }

           

            //jika posisi centroid tidak berubah, hentikan iterasi
            if ($centroids === $new_centroids) {
            break;
            } else {
            //simpan posisi centroid baru
            $centroids = $new_centroids;
            $iterasi++;
            }
        }

        asort($centroids);
        

        

        $age = $_POST['age'];
        $chol = $_POST['chol'];
        $fbs = $_POST['fbs'];

        $input = array($age, $chol, $fbs);
        

        $jarak_input_centroid = array();
        foreach ($centroids as $centroid) {
            $distance = sqrt(pow($age - $centroid['age'], 2) + pow($chol - $centroid['chol'], 2) + pow($fbs - $centroid['fbs'], 2));
            $jarak_input_centroid[] = $distance;
        }

        $kluster_terdekat = array_search(min($jarak_input_centroid), $jarak_input_centroid);

        

        $kombinasi = array();
        $io = array();
        $output = array();
        foreach ($data as $row) {
            if ($row['age'] > 40) {
                $umur = 1;
            } else {
                $umur = 0;
            }
            if ($row['chol'] > 240) {
                $kolestrol = 1;
            } else {
                $kolestrol = 0;
            }
            $kombinasi[] = $umur.$kolestrol.$row['fbs'].$row['output'];
            $io[] = $umur.$kolestrol.$row['fbs'];
            $output[] = $row['output'];
        }

        
        // Cari nilai yang setara dengan kombinasi tertentu
        $output0 =  count(array_keys($output, 0));
        $output1 =  count(array_keys($output, 1));
        $all = count($data);
        $counts = array_count_values($io);
        $values = array(
            'nilai_111' => $counts['111'] ?? 0,
            'nilai_110' => $counts['110'] ?? 0,
            'nilai_101' => $counts['101'] ?? 0,
            'nilai_100' => $counts['100'] ?? 0,
            'nilai_011' => $counts['011'] ?? 0,
            'nilai_010' => $counts['010'] ?? 0,
            'nilai_001' => $counts['001'] ?? 0,
            'nilai_000' => $counts['000'] ?? 0,
        );

        

        $input_bayes = array();
        if ($age > 40) {
            $umur = 1;
        } else {
            $umur = 0;
        }
        if ($chol > 240) {
            $kolestrol = 1;
        } else {
            $kolestrol = 0;
        }
        $input_bayes[] = $umur.$kolestrol.$fbs;

      

        $pA = "";
        $prob_0 = "";
        $prob_1 = "";

        foreach (str_split($input_bayes[0]) as $index => $value) {
            if ($index < strlen($input_bayes[0]) - 1) {
                $key = 'nilai_' . $input_bayes[0][$index] . $input_bayes[0][$index + 1] . $value;
                $pA = $values[$key] / $all;
                
                $key0 = $input_bayes[0][$index] . $input_bayes[0][$index + 1] . $value . '0';
                $count_key0 = array_count_values($kombinasi)["$key0"] ?? 0;
                $prob_0 = $count_key0 / $output0;

                $key1 = $input_bayes[0][$index] . $input_bayes[0][$index + 1] . $value . '1';
                $count_key1 = array_count_values($kombinasi)["$key1"] ?? 0;
                $prob_1 = $count_key1 / $output1;
            }
        }

        
        
        // // Hitung nilai probabilitas
        $pengali = $pA * $prob_1;
        $pembagi = $pA * $prob_0;

       

        $naive_bayes = round(($pengali/($pengali+$pembagi))*100);

        
    ?>
    <style>
        :root {
            --tlt-br-cnt: 50;
            --i: 0;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            width: 100vw;
            height: 100vh;

            background: #0f8100;

            overflow: hidden;

            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        .progress {
            width: 200px;
            height: 200px;
            border-radius: 50%;

            display: flex;
            justify-content: center;
            align-items: center;

            position: relative;
        }

        .progress i {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            transform: rotate(calc(45deg + calc(calc(360deg / var(--tlt-br-cnt)) * var(--i))));
        }

        .progress i::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            background: hsla(0, 0%,100%, 12%);;
            width: 5px;
            height: 20px;
            border-radius: 999rem;
            transform: rotate(-45deg);
            transform-origin: top;
            opacity: 0;

            animation: barCreationAnimation 100ms ease forwards;
            animation-delay: calc(var(--i) * 15ms);
        }

        .progress .selected1::after {
            background: hsl(130, 100%, 50%);
            box-shadow: 0 0 1px hsl(130, 100%, 50%),
                        0 0 3px hsl(130, 100%, 30%),
                        0 0 4px hsl(130, 100%, 10%);
        }

        .progress .selected2::after {
            background: hsl(64, 100%, 50%);
            box-shadow: 0 0 1px hsl(64, 100%, 50%),
                        0 0 3px hsl(64, 100%, 30%),
                        0 0 4px hsl(64, 100%, 10%);
        }

        .progress .selected3::after {
            background: hsl(8, 100%, 50%);
            box-shadow: 0 0 1px hsl(8, 100%, 50%),
                        0 0 3px hsl(8, 100%, 30%),
                        0 0 4px hsl(8, 100%, 10%);
        }

        .percent-text {
            font-size: 3rem;
            animation: barCreationAnimation 500ms ease forwards;
            animation-delay: calc(var(--tlt-br-cnt) * 15ms / 2);
        }

        .text1{
            color: hsl(130, 100%, 50%);
            text-shadow: 0 0 1px hsl(130, 100%, 50%),
                            0 0 3px hsl(130, 100%, 30%),
                            0 0 4px hsl(130, 100%, 10%);
            opacity: 0;
        }

        .text2{
            color: hsl(64, 100%, 50%);
            text-shadow: 0 0 1px hsl(64, 100%, 50%),
                        0 0 3px hsl(64, 100%, 30%),
                        0 0 4px hsl(64, 100%, 10%);
            opacity: 0;
        }
        .text3{
            color: hsl(8, 100%, 50%);
            text-shadow: 0 0 1px hsl(8, 100%, 50%),
            0 0 3px hsl(8, 100%, 30%),
            0 0 4px hsl(8, 100%, 10%);
            opacity: 0;
        }

        @keyframes barCreationAnimation {
            from {opacity: 0}
            to {opacity: 1}
        }
        .speedometer-container {
        display: flex;
        justify-content: center;
        align-items: center;
        }

        .speedometer {
        position: relative;
        width: 250px;
        height: 250px;
        margin: 20px;
        }

        .meter {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #eee;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .needle {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transform-origin: bottom center;
        }

        .needle-inner {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: red;
        transform: translate(-50%, -50%);
        }

        .reading {
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 24px;
        transform: translate(-50%, -50%);
        }

    </style>
</head>
<body>
    <div class="progress"></div><br>
    <div class="container">
        <?php if (($kluster_terdekat+1) === 1):?>
            <div class="class">
                <span style='font-size:100px;'>&#128513;</span>
                <h3 style="color: white;">Alhamdulillah Kamu Aman dari Penyakit Jantung</h3>
            </div>
        <?php elseif(($kluster_terdekat+1) === 2):?>
        <span style='font-size:100px;'>&#128516;</span>
        <h3 style="color: white;">Kamu Harus Lebih Berhati hati lagi</h3>
        <?php elseif(($kluster_terdekat+1) === 3):?>
        <span style='font-size:100px;'>&#128546;</span>
        <h3 style="color: white;">Yahhh, Kamu terkena penyakit jantung, TETAP SEMANGAT YAA</h3>
        <?php endif;?>
    </div>
</body>
<script>
    const wrapper = document.querySelectorAll('.progress');

    const barCount = 50;
    const percent1 = 50 * "<?php echo $naive_bayes; ?>" / 100;

    for (let index = 0; index < barCount; index++) {
        const className = index < percent1 ? 'selected1' : '';
        wrapper[0].innerHTML += `<i style="--i: ${index};" class="${className}"></i>`;
    }

    wrapper[0].innerHTML += `<p class="selected percent-text text1"><?php echo $naive_bayes; ?>%</p>`
</script>
</html>