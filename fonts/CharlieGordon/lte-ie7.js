/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'CharlieGordon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-android' : '&#xf085;',
			'icon-shield' : '&#xe00f;',
			'icon-vote' : '&#xe00c;',
			'icon-users' : '&#xe017;',
			'icon-file' : '&#xe059;',
			'icon-circleinfo' : '&#xe016;',
			'icon-asterisk' : '&#xe058;',
			'icon-tie' : '&#x2040;',
			'icon-intersection' : '&#x2229;',
			'icon-todo' : '&#xf480;',
			'icon-tags' : '&#xf004;',
			'icon-wheelchair' : '&#xf3fe;',
			'icon-pie-chart' : '&#xf000;',
			'icon-shopping' : '&#xf010;',
			'icon-scales' : '&#xf3fd;',
			'icon-support' : '&#xf014;',
			'icon-error' : '&#xf04a;',
			'icon-html' : '&#xe001;',
			'icon-braces' : '&#xf015;',
			'icon-presentation' : '&#xf0c4;',
			'icon-volumemute2' : '&#xf0e5;',
			'icon-volumehalf' : '&#xf0e3;',
			'icon-volumefull' : '&#xf0e2;',
			'icon-bluetooth' : '&#xe05b;',
			'icon-instagram' : '&#xf14a;',
			'icon-record' : '&#xf013;',
			'icon-podcast' : '&#xf1a2;',
			'icon-paw' : '&#xe026;',
			'icon-quote' : '&#xe029;',
			'icon-quote-2' : '&#xe01e;',
			'icon-cabinet' : '&#xe004;',
			'icon-microphone' : '&#xe005;',
			'icon-picture' : '&#xe040;',
			'icon-pictures' : '&#xe03e;',
			'icon-checkmark' : '&#xe006;',
			'icon-cancel' : '&#xe007;',
			'icon-location' : '&#xf02f;',
			'icon-vote-2' : '&#xe009;',
			'icon-megaphone' : '&#xe00a;',
			'icon-lamp' : '&#xe00e;',
			'icon-chat' : '&#xe038;',
			'icon-info' : '&#xe053;',
			'icon-paper-plane' : '&#xe056;',
			'icon-paperclip' : '&#xe04a;',
			'icon-user' : '&#xe012;',
			'icon-users-2' : '&#xe013;',
			'icon-user-add' : '&#xe011;',
			'icon-share' : '&#xf29d;',
			'icon-export' : '&#xf16b;',
			'icon-clock' : '&#xe047;',
			'icon-help' : '&#xe057;',
			'icon-warning' : '&#xe046;',
			'icon-sound' : '&#xe04f;',
			'icon-menu' : '&#xe01f;',
			'icon-heart' : '&#xf074;',
			'icon-cog' : '&#xf189;',
			'icon-home' : '&#xf0b4;',
			'icon-tag' : '&#xf08a;',
			'icon-repeat' : '&#xe019;',
			'icon-print' : '&#xe008;',
			'icon-chevron-left' : '&#xf053;',
			'icon-chevron-right' : '&#xf054;',
			'icon-resize-full' : '&#xf065;',
			'icon-resize-small' : '&#xf066;',
			'icon-plus' : '&#xf067;',
			'icon-minus' : '&#xf068;',
			'icon-random' : '&#xe04e;',
			'icon-cogs' : '&#xf12b;',
			'icon-comments' : '&#xe02f;',
			'icon-heart-empty' : '&#xe045;',
			'icon-reorder' : '&#xf0c9;',
			'icon-comments-alt' : '&#xe037;',
			'icon-mobile' : '&#xf10b;',
			'icon-angle-left' : '&#xf104;',
			'icon-angle-right' : '&#xf105;',
			'icon-angle-up' : '&#xf106;',
			'icon-angle-down' : '&#xf107;',
			'icon-pencil' : '&#xe03f;',
			'icon-folder-open' : '&#xe018;',
			'icon-calendar' : '&#xe04d;',
			'icon-map' : '&#xf01e;',
			'icon-quotes-left' : '&#xe02e;',
			'icon-zoom-out' : '&#xe01d;',
			'icon-zoom-in' : '&#xe01b;',
			'icon-search' : '&#xe01c;',
			'icon-spinner' : '&#xe01a;',
			'icon-earth' : '&#xf482;',
			'icon-link' : '&#xe02d;',
			'icon-star' : '&#xe044;',
			'icon-star-2' : '&#xe042;',
			'icon-star-3' : '&#xe041;',
			'icon-pencil-2' : '&#xe03d;',
			'icon-calendar-2' : '&#xe04b;',
			'icon-film' : '&#xe051;',
			'icon-phone' : '&#xe043;',
			'icon-code' : '&#xe049;',
			'icon-googleplus' : '&#xe00d;',
			'icon-googleplus-2' : '&#xe06f;',
			'icon-googleplus-3' : '&#xf086;',
			'icon-facebook' : '&#xe020;',
			'icon-facebook-2' : '&#xe021;',
			'icon-facebook-3' : '&#xe061;',
			'icon-twitter' : '&#xe022;',
			'icon-twitter-2' : '&#xe023;',
			'icon-twitter-3' : '&#xe062;',
			'icon-feed' : '&#xe024;',
			'icon-feed-2' : '&#xe025;',
			'icon-feed-3' : '&#xe066;',
			'icon-vimeo' : '&#xe052;',
			'icon-youtube' : '&#xe050;',
			'icon-vimeo-2' : '&#xe054;',
			'icon-vimeo2' : '&#xe002;',
			'icon-flickr' : '&#xe05c;',
			'icon-flickr-2' : '&#xe05d;',
			'icon-flickr-3' : '&#xe063;',
			'icon-dribbble' : '&#xe05e;',
			'icon-dribbble-2' : '&#xe05f;',
			'icon-dribbble-3' : '&#xe064;',
			'icon-github' : '&#xe034;',
			'icon-github-2' : '&#xe036;',
			'icon-github-3' : '&#xe039;',
			'icon-skype' : '&#xe03b;',
			'icon-reddit' : '&#xe03c;',
			'icon-linkedin' : '&#xe030;',
			'icon-linkedin-2' : '&#xe06a;',
			'icon-linkedin-3' : '&#xe06b;',
			'icon-pinterest' : '&#xe028;',
			'icon-pinterest-2' : '&#xe035;',
			'icon-pinterest-3' : '&#xe02a;',
			'icon-stumbleupon' : '&#xe02b;',
			'icon-stumbleupon-2' : '&#xe033;',
			'icon-stumbleupon-3' : '&#xe02c;',
			'icon-email' : '&#xe014;',
			'icon-email-2' : '&#xe003;',
			'icon-email-3' : '&#xe015;',
			'icon-thumbs-up' : '&#xe000;',
			'icon-thumbs-down' : '&#xe010;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};