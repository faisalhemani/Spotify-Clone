<?php
	include("includes/handlers/registerHandler.php");
	include("includes/handlers/loginHandler.php");
	function getInputValue($name){
		if(isset($_POST[$name])){
			echo $_POST[$name];
		}
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shiafy</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/register.js"></script>
</head>
<body>
	<?php
		if(isset($_POST['registerButton'])){
			echo '<script type="text/javascript">
					$(document).ready(function(){
							$("#loginForm").hide();
							$("#registerForm").show();
						});
				</script>';
		}
		else {
			echo '<script type="text/javascript">
					$(document).ready(function(){
							$("#loginForm").show();
							$("#registerForm").hide();
						});
				</script>';
		}
	?>
	<div id="bg">
		<div id="loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login</h2><p>
					<?php
							echo $account->getError(Constants::$loginFailed);
						?>
					<input id="loginUsername" type="text" name="loginUsername" placeholder="Username" value="<?php getInputValue('loginUsername')?>" required></p>
					<p><input id="loginPassword" type="password" name="loginPassword" placeholder="Password" required></p>
					<button type="sumbit" name="loginButton">Login</button>
					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account yet? Signup here.</span>
					</div>
				</form>

				<form id="registerForm" action="register.php" method="POST">
					<h2>Register For your free account</h2>
					<p>
						<?php
							echo $account->getError(Constants::$invalidUsername);
						?><?php
							echo $account->getError(Constants::$usernameTaken);
						?>
						<input id="registerUsername" type="text" name="registerUsername" placeholder="Username" value="<?php getInputValue('registerUsername')?>" required></p>
					<p><input id="registerFirstname" type="text" name="registerFirstname" placeholder="Firstname" value="<?php getInputValue('registerFirstname')?>"  required></p>
					<p><input id="registerLastname" type="text" name="registerLastname" placeholder="Lastname" value="<?php getInputValue('registerLastname')?>"required></p>
					<p>
						<?php
							echo $account->getError(Constants::$invalidEmail);
						?>
						<?php
							echo $account->getError(Constants::$emailTaken);
						?>
						<input id="registerEmail" type="email" name="registerEmail" placeholder="name@example.com" value="<?php getInputValue('registerEmail')?>"  required></p>
					<p>
						<?php
							echo $account->getError(Constants::$emailsDoNotMatch);
						?>
						<input id="registerEmailConfirm" type="email" name="registerEmailConfirm" placeholder="Confirm Email" required></p>
					<p>
						<?php
							echo $account->getError(Constants::$invalidPassword);
						?>
						<?php
							echo $account->getError(Constants::$invalidPasswordLength);
						?>
						<input id="registerPassword" type="password" name="registerPassword" placeholder="Password" required></p>
					<p>
						<?php
							echo $account->getError(Constants::$passwordsDoNotMatch);
						?>
						<input id="registerPasswordConfirm" type="password" name="registerPasswordConfirm" placeholder="Confirm Password" required></p>
					<button type="sumbit" name="registerButton">Register</button>
					<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Login here.</span>
					</div>
				</form>
			</div>
			<div id="loginText">
				<h1>SHIAFY</h1>
				<h2>A collection of salams, marsiyas, nauhas, qasidey, and manqebaat</h2>
				<ul>
					<li>Stream religious audio for free</li>
					<li>Find text writeups for religious recitations</li>
					<li>More features coming soon</li>
				</ul>
				<h3>Developed by: GROUPNAME</h3>
			</div>
		</div>
	</div>
</body>
</html>

