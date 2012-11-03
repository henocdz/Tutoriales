var $item;
var active,a;
var cpy;


function inicia(e){

	e.dataTransfer.effectAllowed = 'move'

	var self = $(this);
	active = self.index();
	e.dataTransfer.setData('i',active);


	//Imagen

	var ico = new Image;
	ico.src = "http://3.bp.blogspot.com/-KRZG6ZAQ21k/UExPY4WPs8I/AAAAAAAAAVc/hcon2p4DJUY/s1600/trollface.png";
	ico.width = "50px"
	e.dataTransfer.setDragImage(ico,50,50);


	cpy = self.clone();
}

function suelta(e) {

	e.preventDefault();
	e.stopPropagation();

	var self = $(this);
	var sIndex = self.index();
	var prev = parseInt(e.dataTransfer.getData('i'));

	self.css({
		'border-width':'0'
	});


	if(sIndex == prev)
		return false;

	$item.eq(prev).remove();

	if(prev < sIndex)
		cpy.insertAfter( $item.eq(sIndex) )
	else if(prev > sIndex)
		cpy.insertBefore( $item.eq(sIndex) )

	initComponents();
}


function encima(e) {

	e.dataTransfer.dropEffect = 'move';

	var self  = $(this);

	if(self.index() === active)
		return false;

	self.css({
		'border-style':'dashed',
		'border-width':'1px 1px 1px 1px',
		'border-color':'black'
	});

	return false;
}

function entra(e) {
	return false;
}

function fin(e){
	var self  = $(this);

	self.css({
		'border-width':'0'
	});
}



$(function() {

	initComponents();

})

function initComponents() {

	$item = $('.item');

	$.each($item,function(i){
		
		this.ondragstart = inicia;
		this.ondragleave = fin;
		this.ondragover = encima;
		this.ondrop = suelta;

	})
}


