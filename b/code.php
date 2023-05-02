<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_dataset']))
{
    $dataset_id = mysqli_real_escape_string($con, $_POST['delete_dataset']);

    $query = "DELETE FROM dataset WHERE dataset_id='$dataset_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Data Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Data Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_dataset']))
{
    $dataset_id = mysqli_real_escape_string($con, $_POST['dataset_id']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $chol = mysqli_real_escape_string($con, $_POST['chol']);
    $fbs = mysqli_real_escape_string($con, $_POST['fbs']);
    

    $query = "UPDATE dataset SET age='$age', chol='$chol', fbs='$fbs' WHERE dataset_id='$dataset_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Data Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Data Not Updated";
        header("Location: index.php");
        exit(0);
    }

}

if(isset($_POST['edit_dataset']))
{
    $dataset_id = mysqli_real_escape_string($con, $_POST['dataset_id']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $chol = mysqli_real_escape_string($con, $_POST['chol']);
    $fbs = mysqli_real_escape_string($con, $_POST['fbs']);

    $query = "INSERT INTO dataset (age,chol,fbs) VALUES ('$age','$chol','$fbs')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Data Created Successfully";
        header("Location: student-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Data Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}


if(isset($_POST['save_student']))
{
    $dataset_id = mysqli_real_escape_string($con, $_POST['dataset_id']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $chol = mysqli_real_escape_string($con, $_POST['chol']);
    $fbs = mysqli_real_escape_string($con, $_POST['fbs']);

    $query = "INSERT INTO dataset (age,chol,fbs) VALUES ('$age','$chol','$fbs')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Data Created Successfully";
        header("Location: student-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Data Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}

?>