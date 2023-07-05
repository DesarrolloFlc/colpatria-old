// Numero de copos, recomendados entre 30 y 40
/*var nieve_cantidad=60
// Colores de los copos se mostraran de forma aleatoria
var nieve_colorr=new Array("#ffffff","#ddddFF","#ccccDD")
// Tipo de letra de los copos
var nieve_tipo=new Array("Arial Black","Arial Narrow","Times","Comic Sans MS")
// Valor o letra de los copos
var nieve_letra="*"
// velocidad de caida
var nieve_velocidad=1.0
// tamaño mas grande de los copos
var nieve_cantidadsize=30
// tamaño mas pequeño de los copos
var nieve_chico=8
// 1 toda la pagina - 2 zona izquierda - 3 centro de pagina - 4 zona derecha
var nieve_zona=1

var nieve=new Array()
var marginbottom
var marginright
var timer
var i_nieve=0
var x_mv=new Array();
var crds=new Array();
var lftrght=new Array();
var browserinfos=navigator.userAgent
var ie5=document.all&&document.getElementById&&!browserinfos.match(/Opera/)
var ns6=document.getElementById&&!document.all
var opera=browserinfos.match(/Opera/)
var browserok=ie5||ns6||opera

function aleatorio(range) {
	rand=Math.floor(range*Math.random())
	return rand
}

function initnieve() {
	if (ie5 || opera) {
		marginbottom = document.body.clientHeight
		marginright = document.body.clientWidth
	}
	else if (ns6) {
		marginbottom = window.innerHeight
		marginright = window.innerWidth
	}
	var nievesizerange=nieve_cantidadsize-nieve_chico
	for (i=0;i<=nieve_cantidad;i++) {
		crds[i] = 0;
		lftrght[i] = Math.random()*15;
		x_mv[i] = 0.03 + Math.random()/10;
		nieve[i]=document.getElementById("s"+i)
		nieve[i].style.fontFamily=nieve_tipo[aleatorio(nieve_tipo.length)]
		nieve[i].size=aleatorio(nievesizerange)+nieve_chico
		nieve[i].style.fontSize=nieve[i].size
		nieve[i].style.color=nieve_colorr[aleatorio(nieve_colorr.length)]
		nieve[i].sink=nieve_velocidad*nieve[i].size/5
		if (nieve_zona==1) {nieve[i].posx=aleatorio(marginright-nieve[i].size)}
		if (nieve_zona==2) {nieve[i].posx=aleatorio(marginright/2-nieve[i].size)}
		if (nieve_zona==3) {nieve[i].posx=aleatorio(marginright/2-nieve[i].size)+marginright/4}
		if (nieve_zona==4) {nieve[i].posx=aleatorio(marginright/2-nieve[i].size)+marginright/2}
		nieve[i].posy=aleatorio(2*marginbottom-marginbottom-2*nieve[i].size)
		nieve[i].style.left=nieve[i].posx
		nieve[i].style.top=nieve[i].posy
	}	
	movenieve()
}

function movenieve() {
	for (i=0;i<=nieve_cantidad;i++) {
		crds[i] += x_mv[i];
		nieve[i].posy+=nieve[i].sink
		nieve[i].style.left=nieve[i].posx+lftrght[i]*Math.sin(crds[i]);
		nieve[i].style.top=nieve[i].posy

		if (nieve[i].posy>=marginbottom-2*nieve[i].size || parseInt(nieve[i].style.left)>(marginright-3*lftrght[i])){
			if (nieve_zona==1) {nieve[i].posx=aleatorio(marginright-nieve[i].size)}
			if (nieve_zona==2) {nieve[i].posx=aleatorio(marginright/2-nieve[i].size)}
			if (nieve_zona==3) {nieve[i].posx=aleatorio(marginright/2-nieve[i].size)+marginright/4}
			if (nieve_zona==4) {nieve[i].posx=aleatorio(marginright/2-nieve[i].size)+marginright/2}
			nieve[i].posy=0
		}
	}
	var timer=setTimeout("movenieve()",50)	
}

for (i=0;i<=nieve_cantidad;i++) {
	document.write("<span id='s"+i+"' style='position:absolute;top:-"+nieve_cantidadsize+"'>"+nieve_letra+"</span>")
}
if (browserok) {
	window.onload=initnieve	
}*/
var SNOW_Picture = "resources/scripts/snow1.gif"
var SNOW_no = 15;
var SNOW_browser_IE_NS;
var SNOW_browser_MOZ;
var SNOW_browser_IE7;
var SNOW_Time;
var SNOW_dx, SNOW_xp, SNOW_yp;
var SNOW_am, SNOW_stx, SNOW_sty; 
var i, SNOW_Browser_Width, SNOW_Browser_Height;
//SNOW_Browser_Height = 2000;
SNOW_dx = new Array();
SNOW_xp = new Array();
SNOW_yp = new Array();
SNOW_am = new Array();
SNOW_stx = new Array();
SNOW_sty = new Array();
function SNOW_Weather() 
{ 

for (i = 0; i < SNOW_no; ++ i) 
{ 
	SNOW_yp[i] += SNOW_sty[i];
	if (SNOW_yp[i] > SNOW_Browser_Height-50) 
	{
		SNOW_xp[i] = Math.random()*(SNOW_Browser_Width-SNOW_am[i]-30);
		SNOW_yp[i] = 0;
		SNOW_stx[i] = 0.02 + Math.random()/10;
		SNOW_sty[i] = 0.7 + Math.random();
	}
	SNOW_dx[i] += SNOW_stx[i];
	document.getElementById("SNOW_flake"+i).style.top=SNOW_yp[i]+"px";
	document.getElementById("SNOW_flake"+i).style.left=SNOW_xp[i] + SNOW_am[i]*Math.sin(SNOW_dx[i])+"px";
}
SNOW_Time = setTimeout("SNOW_Weather()", 10);
}
jQuery(document).ready( function() {

////////////////////////////////////////////////////////////////

// Javascript made by Rasmus - http://www.peters1.dk //

////////////////////////////////////////////////////////////////
SNOW_browser_IE_NS = (document.body.clientHeight) ? 1 : 0;
SNOW_browser_MOZ = (self.innerWidth) ? 1 : 0;
SNOW_browser_IE7 = (document.documentElement.clientHeight) ? 1 : 0;

if (SNOW_browser_IE_NS)
{
	SNOW_Browser_Width = document.body.clientWidth;
	SNOW_Browser_Height = document.body.clientHeight;
}
else if (SNOW_browser_MOZ)
{
	SNOW_Browser_Width = self.innerWidth - 20;
	SNOW_Browser_Height = self.innerHeight;
}
else if (SNOW_browser_IE7)
{
	SNOW_Browser_Width = document.documentElement.clientWidth;
	SNOW_Browser_Height = document.documentElement.clientHeight;
}

for (i = 0; i < SNOW_no; ++ i) 
{ 
	SNOW_dx[i] = 0; 
	SNOW_xp[i] = Math.random()*(SNOW_Browser_Width-50);
	SNOW_yp[i] = Math.random()*SNOW_Browser_Height;
	SNOW_am[i] = Math.random()*20; 
	SNOW_stx[i] = 0.02 + Math.random()/10;
	SNOW_sty[i] = 0.7 + Math.random();
	if (i == 0) jQuery('body').prepend("<\div id=\"SNOW_flake"+ i +"\" style=\"position: absolute; z-index:200; visibility: visible; top: 15px; left: 15px;\"><a href=\"http://www.spiders-design.co.uk\" target=\"_blank\"><\img src=\""+SNOW_Picture+"\" border=\"0\"></a><\/div>");

	else jQuery('body').prepend("<\div id=\"SNOW_flake"+ i +"\" style=\"position: absolute; z-index: 200; visibility: visible; top: 15px; left: 15px;\"><\img src=\""+SNOW_Picture+"\" border=\"0\"><\/div>");

}
SNOW_Weather();

});