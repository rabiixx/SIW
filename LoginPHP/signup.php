<?php 
require 'header.php';
?>



<main>
	<div>
		<section>
			<h1>Signup</h1>
			<form action="includes/signup.inc.php" method="post">
				
				<label for="Username"></label>
				<input type="text" name="uid" placeholder="Username">
				
				<!-- type="email" -->
				<input type="text" name="mail" placeholder="E-mail">
				<input type="password" name="pwd" placeholder="Password">
				<input type="password" name="pwd-repeat" placeholder="Repeat Password">
				
				<!-- <input type="submit" -->
				<button type="submit" name="signup-submit">Signup</button>
			</form>
		</section>
	</div>
</main>


<?php 
require 'footer.php';
 ?>