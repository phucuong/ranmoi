(function(){var n=this;var aa=window;var q=function(a,b){this.width=a;this.height=b};var r=function(a){try{return!!a.location.href||""===a.location.href}catch(b){return!1}};var s=function(a,b){this.x=void 0!==a?a:0;this.y=void 0!==b?b:0};var t,u,v,w,x=function(){return n.navigator?n.navigator.userAgent:null};w=v=u=t=!1;var y;if(y=x()){var ba=n.navigator;t=0==y.lastIndexOf("Opera",0);u=!t&&(-1!=y.indexOf("MSIE")||-1!=y.indexOf("Trident"));v=!t&&-1!=y.indexOf("WebKit");w=!t&&!v&&!u&&"Gecko"==ba.product}var A=t,B=u,C=w,D=v,E=function(){var a=n.document;return a?a.documentMode:void 0},F;
r:{var G="",H;if(A&&n.opera)var I=n.opera.version,G="function"==typeof I?I():I;else if(C?H=/rv\:([^\);]+)(\)|;)/:B?H=/\b(?:MSIE|rv)[: ]([^\);]+)(\)|;)/:D&&(H=/WebKit\/(\S+)/),H)var J=H.exec(x()),G=J?J[1]:"";if(B){var K=E();if(K>parseFloat(G)){F=String(K);break r}}F=G}
var L=F,P={},Q=function(a){var b;if(!(b=P[a])){b=0;for(var g=String(L).replace(/^[\s\xa0]+|[\s\xa0]+$/g,"").split("."),h=String(a).replace(/^[\s\xa0]+|[\s\xa0]+$/g,"").split("."),e=Math.max(g.length,h.length),c=0;0==b&&c<e;c++){var l=g[c]||"",p=h[c]||"",m=RegExp("(\\d*)(\\D*)","g"),d=RegExp("(\\d*)(\\D*)","g");do{var f=m.exec(l)||["","",""],k=d.exec(p)||["","",""];if(0==f[0].length&&0==k[0].length)break;b=((0==f[1].length?0:parseInt(f[1],10))<(0==k[1].length?0:parseInt(k[1],10))?-1:(0==f[1].length?
0:parseInt(f[1],10))>(0==k[1].length?0:parseInt(k[1],10))?1:0)||((0==f[2].length)<(0==k[2].length)?-1:(0==f[2].length)>(0==k[2].length)?1:0)||(f[2]<k[2]?-1:f[2]>k[2]?1:0)}while(0==b)}b=P[a]=0<=b}return b},R=n.document,S=R&&B?E()||("CSS1Compat"==R.compatMode?parseInt(L,10):5):void 0;var T;!C&&!B||B&&B&&9<=S||C&&Q("1.9.1");B&&Q("9");var W=function(a){return a?new U(V(a)):T||(T=new U)},V=function(a){return 9==a.nodeType?a:a.ownerDocument||a.document},U=function(a){this.a=a||n.document||document};U.prototype.createElement=function(a){return this.a.createElement(a)};var X=function(a){var b=a.a;a=D||"CSS1Compat"!=b.compatMode?b.body:b.documentElement;b=b.parentWindow||b.defaultView;return B&&Q("10")&&b.pageYOffset!=a.scrollTop?new s(a.scrollLeft,a.scrollTop):new s(b.pageXOffset||a.scrollLeft,b.pageYOffset||a.scrollTop)};
U.prototype.appendChild=function(a,b){a.appendChild(b)};var Y=function(a,b){var g;r:{g=V(a);if(g.defaultView&&g.defaultView.getComputedStyle&&(g=g.defaultView.getComputedStyle(a,null))){g=g[b]||g.getPropertyValue(b)||"";break r}g=""}return g||(a.currentStyle?a.currentStyle[b]:null)||a.style&&a.style[b]},Z=function(a){var b;try{b=a.getBoundingClientRect()}catch(g){return{left:0,top:0,right:0,bottom:0}}B&&a.ownerDocument.body&&(a=a.ownerDocument,b.left-=a.documentElement.clientLeft+a.body.clientLeft,b.top-=a.documentElement.clientTop+a.body.clientTop);return b},
da=function(a){var b=a.offsetWidth,g=a.offsetHeight,h=D&&!b&&!g;return(void 0===b||h)&&a.getBoundingClientRect?(a=Z(a),new q(a.right-a.left,a.bottom-a.top)):new q(b,g)},ea=/matrix\([0-9\.\-]+, [0-9\.\-]+, [0-9\.\-]+, [0-9\.\-]+, ([0-9\.\-]+)p?x?, ([0-9\.\-]+)p?x?\)/;var fa=function(a){var b=[],g;for(g in a)b.push(g+"="+a[g]);return b.join("\n")};var ga=function(a){return{"http://googleads.g.doubleclick.net":1,"http://pagead2.googlesyndication.com":1,"https://googleads.g.doubleclick.net":1,"https://pagead2.googlesyndication.com":1}.hasOwnProperty(a)},ha=function(a){var b,g=a.origin,h=a.data.split("\n");b={};for(var e=0;e<h.length;e++){var c=h[e].indexOf("=");-1!=c&&(b[h[e].substr(0,c)]=h[e].substr(c+1))}if("google_loc_request"==b[0]&&(top==window||ga(g))){h={};h[1]=b[1];h[2]=2;b=window;for(var e=0,c=b,l=0;b!=b.parent;)b=b.parent,l++,r(b)&&
(c=b,e=l);b=c;h[3]=b.location.href;h[4]=ga(g)?b.document.referrer:"";h[5]=e;var e=a.source,p,m,d,f;if(b==window.top){d=e;for(f=d.parent;f!=window.top;f=f.parent)r(f)||(d=f);e=d;f=e.parent.document.getElementsByTagName("iframe");d=null;for(c=0;c<f.length;c++)if(f[c].contentWindow==e){d=f[c];break}if(d){p=new s(0,0);m=V(d)?V(d).parentWindow||V(d).defaultView:window;f=d;do{if(m==b){var c=f,k=void 0,l=V(c);Y(c,"position");var e=new s(0,0),k=void 0,k=l?V(l):document,z=void 0;(z=!B)||(z=void 0,(z=B&&9<=
S)||(z="CSS1Compat"==W(k).a.compatMode));c!=(z?k.documentElement:k.body)&&(k=Z(c),c=X(W(l)),e.x=k.left+c.x,e.y=k.top+c.y)}else c=f,e=void 0,e=Z(c),e=new s(e.left,e.top),C&&!Q(12)&&(l=void 0,B?l="-ms-transform":D?l="-webkit-transform":A?l="-o-transform":C&&(l="-moz-transform"),k=void 0,l&&(k=Y(c,l)),k||(k=Y(c,"transform")),c=k?(c=k.match(ea))?new s(parseFloat(c[1]),parseFloat(c[2])):new s(0,0):new s(0,0),e=new s(e.x+c.x,e.y+c.y));p.x+=e.x;p.y+=e.y}while(m&&m!=b&&(f=m.frameElement)&&(m=m.parent));c=
d;"none"!=Y(c,"display")?d=da(c):(d=c.style,m=d.display,f=d.visibility,e=d.position,d.visibility="hidden",d.position="absolute",d.display="inline",c=da(c),d.display=m,d.position=e,d.visibility=f,d=c);m=d}var M;d=b||aa;try{var N;if(d.document&&!d.document.body)N=new q(-1,-1);else{var O=(d||window).document,ca="CSS1Compat"==O.compatMode?O.documentElement:O.body;N=new q(ca.clientWidth,ca.clientHeight)}M=N}catch(ia){M=new q(-12245933,-12245933)}d=M;f=X(W(b.document))}p&&(h[6]=p.x,h[7]=p.y);m&&(h[8]=m.width,
h[9]=m.height);d&&(h[10]=d.width,h[11]=d.height);f&&(h[12]=f.x,h[13]=f.y);a.source.postMessage(fa(h),g)}};window.addEventListener?window.addEventListener("message",ha,!1):window.attachEvent&&window.attachEvent("onmessage",ha);if(window==top)if(document.body){var $=document.createElement("IFRAME");$.frameBorder=0;$.id="google_top_static_frame";$.name="google_top_static_frame";$.style.height=0;$.style.width=0;$.style.position="absolute";$.src="//googleads.g.doubleclick.net/pagead/blank.html";document.body.appendChild($)}else document.write("<iframe frameBorder='0' src='//googleads.g.doubleclick.net/pagead/blank.html' id='google_top_static_frame' name='google_top_static_frame' style='height:0;width:0;position:absolute'></iframe>");})();
