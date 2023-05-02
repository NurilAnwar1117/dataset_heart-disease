<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="b.css">
    <title>Data Edit</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Edit 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['dataset_id']))
                        {
                            $dataset_id = mysqli_real_escape_string($con, $_GET['dataset_id']);
                            $query = "SELECT * FROM dataset WHERE dataset_id='$dataset_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $dataset = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="dataset_id" value="<?= $dataset['dataset_id']; ?>">

                                    <div class="mb-3">
                                        <label>Age</label>
                                        <input type="text" name="age" value="<?=$dataset['age'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Chol</label>
                                        <input type="text" name="chol" value="<?=$dataset['chol'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Fbs</label>
                                        <input type="text" name="fbs" value="<?=$dataset['fbs'];?>" class="form-control">
                                    </div>
                                   
                                    <div class="mb-3">
                                        <button type="submit" name="update_dataset" class="btn btn-primary">
                                            Update Data
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>