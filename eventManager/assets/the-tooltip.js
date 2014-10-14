;(function(selector) {

if('ontouchstart' in window) {
	
	/* http://code.google.com/p/domready/ */
	(function(){var i=window.DomReady={};var h=navigator.userAgent.toLowerCase();var c={version:(h.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/)||[])[1],safari:/webkit/.test(h),opera:/opera/.test(h),msie:(/msie/.test(h))&&(!/opera/.test(h)),mozilla:(/mozilla/.test(h))&&(!/(compatible|webkit)/.test(h))};var d=false;var e=false;var g=[];function a(){if(!e){e=true;if(g){for(var j=0;j<g.length;j++){g[j].call(window,[])}g=[]}}}function f(j){var k=window.onload;if(typeof window.onload!="function"){window.onload=j}else{window.onload=function(){if(k){k()}j()}}}function b(){if(d){return}d=true;if(document.addEventListener&&!c.opera){document.addEventListener("DOMContentLoaded",a,false)}if(c.msie&&window==top){(function(){if(e){return}try{document.documentElement.doScroll("left")}catch(k){setTimeout(arguments.callee,0);return}a()})()}if(c.opera){document.addEventListener("DOMContentLoaded",function(){if(e){return}for(var k=0;k<document.styleSheets.length;k++){if(document.styleSheets[k].disabled){setTimeout(arguments.callee,0);return}}a()},false)}if(c.safari){var j;(function(){if(e){return}if(document.readyState!="loaded"&&document.readyState!="complete"){setTimeout(arguments.callee,0);return}if(j===undefined){var k=document.getElementsByTagName("link");for(var l=0;l<k.length;l++){if(k[l].getAttribute("rel")=="stylesheet"){j++}}var m=document.getElementsByTagName("style");j+=m.length}if(document.styleSheets.length!=j){setTimeout(arguments.callee,0);return}a()})()}f(a)}i.ready=function(k,j){b();if(e){k.call(window,[])}else{g.push(function(){return k.call(window,[])})}};b()})();
	
	
	DomReady.ready(function() {
		
		try {
		
			for(var i=0, elements = document.querySelectorAll(selector + ' > :last-child'), clicked = false; i<elements.length; i++) {
				
				// iOS opacity + transition + visibility bug fix
				if(navigator.userAgent.match(/iPad|iPhone|iPod/)) elements[i].style.webkitTransitionDuration = '0s';
				
				// adding a click event listener is sufficient for iOS
				elements[i].parentNode.addEventListener('click', function(event) {
					
					// Android hover fix
					if(navigator.userAgent.match(/Android/) && !clicked) (clicked = true) && event.preventDefault();
				});
				
				// Android needs a tabindex too
				elements[i].parentNode.setAttribute('tabindex', 0);
			}
		}
		catch(error) {}
	});
}

})('.the-tooltip');