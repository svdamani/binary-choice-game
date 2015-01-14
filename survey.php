<?php
session_start();
if (!isset($_SESSION['loggedin']))
	header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Binary Choice Game</title>
	<meta charset="utf-8" />
	<link href="css/style.css" rel="stylesheet" />
</head>

<body>
	<header>
		<h2>Welcome</h2>
	</header>
	<nav></nav>
	<aside></aside>
	<article>		
		<p>While you were sampling...</p>
		<form method="POST" onSubmit="return User.SignOut();" action="javascript:location='index.php'">
			<fieldset>
				<legend>Survey</legend>
				<b>1:</b>
				What were the most likely reason(s) for you to stop sampling?
				<br /><input type="checkbox" />
				You were able to determine the frequency of occurrence of outcomes.
				<br /><input type="checkbox" />
				All outcomes were either positive or negative in sign.
				<br /><input type="checkbox" />
				The outcome 32 was much larger in size compared with the outcome 3. 
				<br /><input type="checkbox" />
				The sampling had an opportunity cost during which you could not pursue some other activity.
				<br /><input type="checkbox" />
				You were able to observe all the outcomes on both buttons.
				<br /><input type="checkbox" />
				The sampling had a cognitive cost of thinking about outcomes and then processing this information.
				<br /><input type="checkbox" />
				Some other reason.
				<br />
				<b>2:</b><br />
				<textarea rows="5" cols="100" wrap="physical" placeholder="Specify other reasons"></textarea>
				<br />
				<b>3:</b>
				What do you think was the probability of getting 32 from choosing Action B?
				<input type="number" min="0" max="100" autocomplete="off" />
				<br />
				<b>4:</b>
				What do you think was the probability of getting 0 from choosing Action B? 
				<input type="number" min="0" max="100" autocomplete="off" />
				<br />
				<b>5:</b>
				What do you think was the probability of getting any other outcome from choosing Action B? 
				<input type="number" min="0" max="100" autocomplete="off" />
				<br />
				<b>6:</b>
				What do you think was the probability of getting 3 from choosing Action A? 
				<input type="number" min="0" max="100" autocomplete="off" />
				<br />
				<b>7:</b>
				What do you think was the probability of getting 0 from choosing Action A?
				<input type="number" min="0" max="100" autocomplete="off" />
				<br />
				<b>8:</b>
				What do you think was the probability of getting any other outcome from choosing Action A? 
				<input type="number" min="0" max="100" autocomplete="off" />
				<br />
				<b>9:</b> 
				How lucky do you think you were?
				<select>
					<option value="">-- Choose --</option>
					<option value="1">Not at all</option>
					<option value="2">A little bit</option>
					<option value="3">Somewhat</option>
					<option value="4">Quite a bit</option>
					<option value="5">Very much</option>
				</select>
				<br />
				<b>10:</b>
				How much do you think your own choices affected your outcomes?
				<select>
					<option value="">-- Choose --</option>
					<option value="1">Not at all</option>
					<option value="2">A little bit</option>
					<option value="3">Somewhat</option>
					<option value="4">Quite a bit</option>
					<option value="5">Very much</option>
				</select>
				<br />
				<b>11:</b> 
				How much do you think the probabilities affected your outcomes? 
				<select>
					<option value="">-- Choose --</option>
					<option value="1">Not at all</option>
					<option value="2">A little bit</option>
					<option value="3">Somewhat</option>
					<option value="4">Quite a bit</option>
					<option value="5">Very much</option>
				</select>
				<br />
				<b>12:</b>
				In your opinion, how risky was Action B?
				<select>
					<option value="">-- Choose --</option>
					<option value="1">Not at all</option>
					<option value="2">A little bit</option>
					<option value="3">Somewhat</option>
					<option value="4">Quite a bit</option>
					<option value="5">Very much</option>
				</select>
				<br />
				<b>13:</b>
				In your opinion, how risky was Action A?
				<select>
					<option value="">-- Choose --</option>
					<option value="1">Not at all</option>
					<option value="2">A little bit</option>
					<option value="3">Somewhat</option>
					<option value="4">Quite a bit</option>
					<option value="5">Very much</option>
				</select>
				<br />
				<button type="submit">Submit</button>
			</fieldset>
		</form>
	</article>
	<footer>&nbsp;</footer>
	<script src="js/script.js"></script>
</body> 
</html>