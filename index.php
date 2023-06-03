
<html>
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="./css/loginstyle.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="gap">

</div>
<div class="box-form">
	<div class="left">
		<div class="overlay">
		<h2><b>Milk Dairy <br/> Management System</b></h2>
		<p><h3><b>Welcome..!! </b> Sign-in to get started... </h3></p>
		<!-- <span>
			<p>login with social media</p>
			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Login with Twitter</a>
		</span> -->
		</div>
	</div>
	
	
		<div class="right">
		<h5>Login</h5>
        <form action="auth/login.php" method="POST">
		<div class="inputs">
            
			<input type="text" name="username" placeholder="employee id">
			<br>
			<input type="password"  name="password" placeholder="password">
		</div>
			
			<br><br>
			
			<br>
			<button name="login-btn" >Login</button>
</form>
	</div>
	
</div>
<!-- partial -->
  
</body>
</html>
<?php include 'incl/footer.incl.php'; ?>
