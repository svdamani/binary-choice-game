<?php
abstract class Mode {
	const S = 'Sampling';
	const R = 'Repeated';
	public static function Rand() {
		$var = array(self::S, self::R);
		return $var[array_rand($var)];
	}
}
$mode = Mode::Rand();

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
		<h2>&nbsp;</h2>
	</header>
	<button id="signout" onClick="User.SignOut();location='index.php'">Sign Out</button>
	<nav></nav>
	<aside></aside>
	<article>
		<section id="game">
			<h3 id="heading"><?php echo $mode . " Stage"; ?></h3>
			<button id="safe" accesskey="s" onClick="Run(this)"></button>
			<button id="risk" accesskey="r" onClick="Run(this)"></button>
			<br />
<?php if ($mode === Mode::S) { ?>
			<button id="final" onClick="FinalChoice()">Final Choice</button>
<?php } else if ($mode === Mode::R) { ?>
			<p>Pay-off from current trial: <b id="msg">0</b></p>
<?php } ?>
		</section>
	</article>
	<footer>&nbsp;</footer>
	<script src="js/ki.js"></script>
	<script src="js/script.js"></script>
	<script src="js/game.js" data-mode="<?php echo $mode; ?>"></script>
</body>
</html>