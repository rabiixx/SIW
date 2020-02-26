<?php 
	session_start();
?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name ="description" content="This will often show up in search results." >
	<meta name = viewport content="width=device-width, initial-scale=1" >
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

	<header>
		<nav>
			<div class="text-center">
				<a href="#">
			  		<img src="img/hacker.png" class="rounded" alt="logo" height="150" width="150">
				</a>
			</div>

			<!--<a href="#">
				<img src="img/hacker.png" alt="logo" height="150" width="150">
			</a>-->

			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Portfolio</a></li>
				<li><a href="#">About me</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
			
			<div>
					<?php  
						if (isset($_SESSION['userId'])) {
							echo '<form action="includes/logout.inc.php" method="post">
										<button type="submit" name="logout-submit">Logout</button>
								  </form>';
						} else {
							echo '
 							<div class="form-group row">
								<form action="includes/login.inc.php" method="post">
									<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
									 <div class="col-sm-10">
									<input type="text" name="mailuid" class="form-control" placeholder="Username/E-mail...">
									 </div>
									<input type="password" name="pwd" placeholder="Password...">
									<button type="submit" name="login-submit">Login</button>
								  </form>
								<a href="signup.php">Signup</a>
							</div>';	
						}
					?>
			</div>
		</nav>
	</header>
</body>
</html>