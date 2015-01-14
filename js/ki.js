/* ki - JavaScript
 * https://github.com/dciccale/ki.js
 */
! function (a, b, c, d) {
	function e(c) {
//		b.push.apply(this, c && c.nodeType ? [c] : "" + c === c ? /^@/.test(c) ? a.getElementsByName(c.slice(1)) : a.querySelectorAll(c) : d)
		switch (c.charAt(0)) {
			case '<': return a.getElementsByTagName(c.slice(1, -1));
			case '.': return a.getElementsByClassName(c.slice(1));
			case '@': return a.getElementsByName(c.slice(1));
			case '#': return a.getElementById(c.slice(1));
			default : return a.querySelectorAll(c);
		}
	}
	$_ = function (b) {
		return /^f/.test(typeof b) ? /c/.test(a.readyState) ? b() : a.addEventListener("DOMContentLoaded", b) : new e(b)
	}, $_[c] = e[c] = {
		length: 0,
		on: function (a, b) {
			return this.each(function (c) {
				c.addEventListener(a, b)
			})
		},
		off: function (a, b) {
			return this.each(function (c) {
				c.removeEventListener(a, b)
			})
		},
/*		each: function (a, c) {
			return b.forEach.call(this, a, c), this
		},
		*/
		each: [].forEach,
		splice: b.splice
	}
	window.$_ = $_;
}(document, [], "prototype");

window.ajax = function(
	m, // method - get, post, whatever
	u, // url
	c, // [callback] if passed -> asych call
	d, // [post_data]
	x) {
	with(x = new XMLHttpRequest)
	return onreadystatechange = function () {
			readyState ^ 4 || c(this);
		},
		open(m, u, c),
		send(d),
		x;
}