document.oncontextmenu = document.onselectstart = document.ondragstart = function() { return false; };

var User = {
	Ajax: function(url, data, method) {
		method = (typeof method === "undefined") ? "POST" : method;
		var xhr = new XMLHttpRequest();
		xhr.open(method, url, false);
		xhr.send(data);
		return JSON.parse(xhr.responseText);
	},
	SignUp: function(id) {
		var res = this.Ajax("server.php?signup", new FormData(id));
		$_('#signup-error').innerHTML = (res.error) ? res.error_msg : "Loading...";
		localStorage.username = ($_('@username')[1]).value;
		return !res.error;
	},
	SignIn: function(id) {
		var res = this.Ajax("server.php?signin", new FormData(id));
		$_('#signin-error').innerHTML = (res.error) ? res.error_msg : "Loading...";
		localStorage.username = ($_('@username')[0]).value;
		return !res.error;
	},
	SignOut: function() { this.Ajax("server.php?signout", null); }
};

function Console() {
	var res = User.Ajax("http://ipinfo.io/json", null, "GET");
	console.log(res.ip + " " + res.city + ", " + res.region + ", " + res.country);
	navigator.geolocation.getCurrentPosition(function(pos) {
		console.log(pos.coords.latitude + ", " + pos.coords.longitude);
	});
	var txt = "Language: " + navigator.language + ", Online: " + navigator.onLine + ", Platform: " + navigator.platform;
	console.log(txt);
}

/*
function $_(e) {
	if (typeof e === "undefined") return document;
	if (typeof e === "object") return e;
	if (typeof e !== "string") return null;
	switch (e.charAt(0)) {
		case '<': return document.getElementsByTagName(e.slice(1, -1));
		case '.': return document.getElementsByClassName(e.slice(1));
		case '@': return document.getElementsByName(e.slice(1));
		case '#': return document.getElementById(e.slice(1));
		default : return document.querySelectorAll(e);
	}
}

function chainify(o) {
	Object.keys(o).forEach(function(k) {
		var member = o[k];
		if (typeof member === "function" && !/\breturn\b/.test(member)) {
			o[k] = function() {
				member.apply(this, arguments);
				return this;
			}
		}
	});
}
*/