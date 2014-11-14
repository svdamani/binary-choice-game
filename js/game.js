var cond = { p: 1.0, w: 3.0, x: 0.0, q: 0.4, y: 32.0, z: 0.0 };
var mode = document.currentScript.getAttribute("data-mode") || "Sampling";
var attempts = (mode === "Sampling") ? 10000 : 50;

function Run(id) {
	$_('#safe').innerHTML = (Math.random() < cond.p) ? cond.w : cond.x;
	$_('#risk').innerHTML = (Math.random() < cond.q) ? cond.y : cond.z;
	attempts--;
	if (mode === "Repeated")
		$_('#msg').innerHTML = id.innerHTML;
	if (attempts === 0) {
		$_('#safe').disabled = $_('#risk').disabled = "disabled";
		localStorage.cond = cond;
		//location = "survey.php";
	}
}

function FinalChoice() {
	$_('#final').hidden = "hidden";
	$_('#heading').innerHTML += " - Real Game";
	$_('#safe').disabled = $_('#risk').disabled = $_('#safe').innerHTML = $_('#risk').innerHTML = "";
	attempts = 1;
}