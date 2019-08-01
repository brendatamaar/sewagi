/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referencing this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
		'moon-office': '&#xe900;',
		'moon-linkedin': '&#xe901;',
		'moon-whatsapp': '&#xe902;',
		'moon-facebook2': '&#xe903;',
		'moon-google': '&#xe904;',
		'moon-eye-blocked': '&#xe905;',
		'moon-eye': '&#xe906;',
		'moon-person_outline': '&#xe907;',
		'moon-arrow_drop_down': '&#xe908;',
		'moon-flag': '&#xe909;',
		'moon-phone': '&#xe90a;',
		'moon-close': '&#xe90b;',
		'moon-cake': '&#xe90c;',
		'moon-document': '&#xe90d;',
		'moon-long-arrow': '&#xe90e;',
		'moon-arrow_left': '&#xe90f;',
		'moon-home_02': '&#xe910;',
		'moon-minus': '&#xe911;',
		'moon-get_money': '&#xe912;',
		'moon-setting': '&#xe913;',
		'moon-plus': '&#xe914;',
		'moon-check': '&#xe915;',
		'moon-mail': '&#xe916;',
		'moon-key': '&#xe917;',
		'moon-user_01': '&#xe918;',
		'moon-card': '&#xe919;',
		'moon-money': '&#xe91a;',
		'moon-gojeg': '&#xe91b;',
		'moon-bedroom': '&#xe91c;',
		'moon-lock': '&#xe91d;',
		'moon-info': '&#xe91f;',
		'moon-arrow_down': '&#xe920;',
		'moon-edit': '&#xe921;',
		'moon-calenda': '&#xe922;',
		'moon-call': '&#xe923;',
		'moon-user-group': '&#xe925;',
		'moon-row': '&#xe926;',
		'moon-heart': '&#xe927;',
		'moon-school': '&#xe928;',
		'moon-fav': '&#xe929;',
		'moon-land_mark': '&#xe92a;',
		'moon-instagram': '&#xe92b;',
		'moon-twitter': '&#xe92c;',
		'moon-gender': '&#xe92d;',
		'moon-parkir': '&#xe92e;',
		'moon-lift': '&#xe92f;',
		'moon-kolam': '&#xe930;',
		'moon-food': '&#xe931;',
		'moon-wifi': '&#xe932;',
		'moon-kuas': '&#xe933;',
		'moon-tree': '&#xe934;',
		'moon-iron': '&#xe935;',
		'moon-driyer': '&#xe936;',
		'moon-cuci': '&#xe937;',
		'moon-tv': '&#xe938;',
		'moon-home': '&#xe939;',
		'moon-gear': '&#xe93a;',
		'moon-user': '&#xe93b;',
		'moon-logo_01': '&#xe93d;',
		'moon-flag_2': '&#xe93e;',
		'moon-map1': '&#xe94d;',
		'moon-map': '&#xe94c;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/moon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
