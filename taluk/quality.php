<?php
include 'tlksidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>price chart</title>
    
	<!-- Demo CSS -->
	<link rel="stylesheet" href="../css/search.css">

    <!-- Bootstrap 5 CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous"> -->
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      
<style>
    body {
  background:linear-gradient(to right, #78a7ba 0%, #385D6C 50%, #78a7ba 99%);
}


.cd-table-container{
  background: #fff;
  box-shadow: 1px 2px 26px rgba(0, 0, 0, 0.2);
  padding: 15px;
  max-width: 720px;
  margin-top:6.5%;
}
/* Table Design */
.cd-table{
  width: 100%;
  color: #666;
  margin: 10px auto;
  border-collapse: collapse;
}

.cd-table tr,
.cd-table td{
  border: 1px solid #ccc;
  padding: 10px;
}
.cd-table th{
  background: #017721;
  color: #fff;
  padding: 10px;
}

/* Search Box */
.cd-search{
  padding: 10px;
  border: 1px solid #ccc;
  width: 100%;
  box-sizing: border-box;
}

/* Search Title */
.cd-title{
  color: #666;
  margin: 15px 0;
}





</style>
  
  </head>
  <body>
  
 <main >
<!-- partial:index.partial.html -->
<section class=" cd-table-container">
    <h1> CLR VALUE CHART </h1>
  <h3 class="cd-title">Search Record:</h3>
  <input type="text" class="cd-search table-filter" data-table="order-table" placeholder="Item to filter.." />


  <table class="cd-table order-table table">
    <thead>
      <tr>
        <th>Fat content</th>
        <th>Minimum CLR</th>
      </tr>
    </thead>

    <tbody>

    <?php

$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");
include 'incl/conn.incl.php';
$res = mysqli_query($conn,"SELECT * FROM quality");

if(mysqli_num_rows($res)>0)
{
        
$i=0;
while($fetch=mysqli_fetch_assoc($res))
{
    $i++;
echo"
<tr>
<td>".$fetch['fat']."</td>
<td>".$fetch['clr']."</td>
</tr>";
}
}
else{
echo '<span style="color:Red"> "No records found"</span>';
}
?>

     
        
    </tbody>
  </table>

</section>
<!-- partial -->
 </main>
  
<!-- Table Search JS -->
  <script  src="../js/admin/search.js"></script>
  
  </body>
</html>
<?php include '../incl/footer.incl.php'; ?>