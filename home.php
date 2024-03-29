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

include_once('server.php');

//echo DB_HOST . DB_USER . DB_PASS ;
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * from sg_trials";
$result = $conn->query($sql);
$sg_trial_rows = $result->num_rows;
$trial=-1;
$user=1;

while($row = $result->fetch_assoc())	{
	$sql = "SELECT * FROM used_conditions WHERE user_id=".$user." and
		trial_id=".$row["ID"];
	$sub_result = $conn->query($sql);
	//$num_rows = (int)$sub_result->num_rows;
	//echo $num_rows ;
	$num_rows = 0;
	if($num_rows % 50 != 0)	{
		$trial = $row["ID"];
		$attempts = $num_rows % 50;
		break;
	}
}

if($trial==-1)	{
	$trial = rand() % $sg_trial_rows + 1;
	$attempts = 5;
}

//echo $trial . $attempts ;
$sql = "SELECT * FROM sg_trials where ID=".$trial;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$permutation = $row["permutation"];

for ($i=0; $i<strlen($permutation); $i++)	{
	$sql = "SELECT * FROM sg_conditions where problem_id=".$permutation[$i];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$conditions[] = array("p" => $row["p"], "w"=> $row["w"], "x"=> $row["x"], "q"=> $row["q"], "y"=> $row["y"], "z"=> $row["z"]);
};

//print_r($conditions);

?>

<script type="text/javascript">
	//document.write("Hello, World!")
	var attempts = "<?= $attempts ?>";
	var trial = "<?= $trial ?>"
	var condition_count = "<?= strlen($permutation) ?>"
	
	var cond = JSON.parse('<?= json_encode($conditions) ?>');
</script>
<script type="text/javascript" src="js/game.js"></script>

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
	<button id="signout" onClick="User.SignOut();location='server.php'">Sign Out</button>
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
