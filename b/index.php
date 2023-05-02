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
    <title>Data </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="j.css">
    <script src="p.js"></script>
    <style>
body {  background-image: url(img/75.png);
    background-size: auto;

}
    
        </style>
</head>
<body>

<div class="topnav">
  <a class="active" href="../dataset.php"><i class="fa fa-fw fa-home"></i> Home</a>
  <a  href="index.php"><i class="fa fa-fw fa-search"></i> Dataset</a>
  <a  href="../confusion_matrix.php"><i class="fa fa-fw fa-envelope"></i> Confusion-matrix</a>
</div>
    <div class="container mt-4">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h4>Data Details
                            <a href="student-create.php" class="btn btn-primary float-end">Add Data</a>
                        </h4> -->
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Age</th>
                                    <th>Chol</th>
                                    <th>fbs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM dataset";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $dataset)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $dataset['dataset_id']; ?></td>
                                                <td><?= $dataset['age']; ?></td>
                                                <td><?= $dataset['chol']; ?></td>
                                                <td><?= $dataset['fbs']; ?></td>
                                                <td>
                                                    <a href="student-view.php?dataset_id=<?= $dataset['dataset_id']; ?>" class="btn btn-info btn-sm">View</a>
                                                    <a href="student-edit.php?dataset_id=<?= $dataset['dataset_id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_dataset" value="<?=$dataset['dataset_id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>