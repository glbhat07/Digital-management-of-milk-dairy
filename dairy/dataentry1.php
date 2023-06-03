<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
    <style>
        .card{
            margin-left:17%;
            margin-top:5%;
        }
       
        a{
            text-decoration:none;
        }
    </style>
</head>
<body>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> -->
    
    <div class="card mx-6">
        <div class="card-content py-4 px-6">
            <div class="content">
                <h1 class="text-center">Enter the Data</h1>
                <form class="row g-3 py-3 px-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Card Number</span>
                        <input type="text" class="form-control">
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                      </div>
                      <div class="input-group mb-3">
                          <span class="input-group-text">Quantity</span>
                        <input type="text" class="form-control">
                        <span class="input-group-text">Fat</span>
                        <input type="text" class="form-control">
                      </div>
            <div class="col-md-3 py-4 px-6">
                <label> </label>
                <span>Buffalo-Milk  <input class="form-check-input" type="checkbox" value="" id="buffalomilk"></span>
            </div>
            
            <div class="col-md-3 py-4 px-6">
                <span>Cow-Milk  <input class="form-check-input" type="checkbox" value="" id="cowmilk"></span>
            </div>
    
            <div class="col-md-5 py-4 px-4">
                <span>LR Value: <input type="number" id="inputlr"></span>
            </div>
            <br/>
            
            <div class=" text-center">
                <div class="">
                    <label for="inputfat" class="form-label">TOTAL</label>
                    <input type="number" class="form-control" id="inputfat">
                </div>
            </div>
            <div class="text-center ">
                <br/><br/>
                <button type="button" class="btn btn-success btn-lg btn-block">Enter</button>            </div>
        </form>
    </div>
</div>
</div>
</section>
</body>
</html>   

<?php

include 'dairysidebar.php';
?>
<?php include '../incl/footer.incl.php'; ?>