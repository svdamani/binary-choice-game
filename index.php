<?php
error_reporting(E_ALL);
session_start();
//$_SESSION['loggedin'] = 1;
//unset($_SESSION['loggedin']);
if (isset($_SESSION['loggedin']))
	header("Location: home.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Binary Choice Game</title>
	<link href="css/style.css" rel="stylesheet" />
</head>

<body>
	<header>
		<h2>Welcome!</h2>
	</header>
	<nav></nav>
	<aside></aside>
	<article>
		<section id="intro">
			<p>
				This game is part of a research study.
				The purpose of the research is to study the decision-making process.
				Participation in this study is limited to individuals aged 18 and older.
				Your participation in this research is voluntary.
				You may discontinue participation at any time during the research activity.
			</p>
		</section>
		<section id="signin">
			<form method="POST" onSubmit="return User.SignIn(this);" action="javascript:location='home.php'">
				<fieldset>
					<legend>Sign In</legend>
					<input type="text"     name="username" placeholder="Username" required />
					<input type="password" name="password" placeholder="Password" required />
					<button type="submit">Sign In</button>
					<button type="reset" onClick="$_('#signin-error').innerHTML=''">Reset</button>
					<small id="signin-error"></small>
				</fieldset>
			</form>
		</section>
		<section id="signup">
			<form method="POST" onSubmit="return User.SignUp(this);" action="javascript:location='home.php'">
				<fieldset>
					<legend>Sign Up</legend>
					<input type="email" name="email" placeholder="Email Address" autocomplete="on" required />
					<select name="gender" required>
						<option value="">-- Gender --</option>
						<option value="M">Male</option>
						<option value="F">Female</option>
					</select><br />
					<input type="text" name="country" placeholder="Country" autocomplete="on" required />
					<select name="education" required>
						<option value="">-- Education --</option>
						<option value="High School">High School</option>
						<option value="College degree">College degree</option>
						<option value="Masters degree">Masters degree</option>
						<option value="Doctorate degree">Doctorate degree</option>
					</select><br />
					<input type="text" name="language" placeholder="Native Language" autocomplete="on" required />
					<select name="religion" required>
						<option value="">-- Religion --</option>
						<option value="Hindu">Hindu</option>
						<option value="Buddhist">Buddhist</option>
						<option value="Christian">Christian</option>
						<option value="Jewish">Jewish</option>
						<option value="Muslim">Muslim</option>
						<option value="Other">Other</option>
					</select><br />
					<input type="number" name="age" placeholder="Age" min="18" max="99" autocomplete="on" required />
					<select name="politics" required>
						<option value="">-- Political Affiliation --</option>
						<option value="Very conservative">Very conservative</option>
						<option value="Somewhat conservative">Somewhat conservative</option>
						<option value="Neutral">Neutral</option>
						<option value="Somewhat liberal">Somewhat liberal</option>
						<option value="Very liberal">Very liberal</option>
					</select><br />
					<input type="text"     name="username" placeholder="Username" autocomplete="on" required />
					<input type="password" name="password" placeholder="Password" autocomplete="on" required />
					<br />
					<label>
						<input type="checkbox" required />
						I have read and understood the information above
					</label>
					<br />
					<label>
						<input type="checkbox" required />
						I want to participate in this research and continue with the game
					</label>
					<br />
					<button type="submit">Sign Up</button>
					<button type="reset" onClick="$_('#signup-error').innerHTML=''">Reset</button>
					<small id="signup-error"></small>
				</fieldset>
			</form>
		</section>
	</article>
	<footer>
		<p id="info"></p>
	</footer>
	<script src="js/ki.js"></script>
	<script src="js/script.js"></script>
	<script>
	$_(function() {
		if (localStorage.username) {
			($_('@username')[0]).value = localStorage.username;
			($_('@password')[0]).focus();
		}
		else
			($_('@username')[0]).focus();
	});
	</script>
</body> 
</html>
