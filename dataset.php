<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>program alanisis serangan jantung</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="j.css">
    <script src="p.js"></script>
    <script>
        $(document).ready(function () {
            age = $(".age").val();
            chol = $(".chol").val();
            fbs = $(".val").val();
        });
    </script>
    <style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-image: url(img/75.png);
  background-size: cover;

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
<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <form action="k-means.php" id="regForm" method="post">
                <h1 id="register">Heart Disease</h1>
                <div class="all-steps" id="all-steps"> 
                  <span class="step"><i class="fa fa-user"></i></span> 
                  <span class="step"><i class="fa fa-heart"></i></span>
                  <span class="step"><i class="fa fa-shopping-bag"></i></span>
                </div>

                <div class="tab">
                  <h6>How Old Are You?</h6>
                    <p>
                      <input placeholder="Age..." oninput="this.className = ''" name="age"></p>
                    
                </div>
                <div class="tab">
                  <h6>Cholestrpol?</h6>
                    <p><input placeholder="Cholestrol" oninput="this.className = ''" name="chol"></p>
                    
                </div>
                <div class="tab">
                    <h6>fbs?</h6>
                    <!-- <p><input placeholder="fbs" oninput="this.className = ''" name="fbs"></p> -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">fbs</label>
                        </div>
                        <select class="custom-select" oninput="this.className = ''" name="fbs">
                            <option selected>Choose...</option>
                            <option value="0">zero</option>
                            <option value="1">One</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" data-toggle="modal" data-target="#myModal">submit</button>
                </div>
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;">
                      <button type="button" id="prevBtn" onclick="nextPrev(-1)"><i class="fa fa-angle-double-left"></i></button> 
                      <button type="button" id="nextBtn" onclick="nextPrev(1)"><i class="fa fa-angle-double-right"></i></button> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>