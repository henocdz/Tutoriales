$(function (){

	moveSlider( $('nav ul li').eq( parseInt( $('nav ul').attr('data-primary') ) ) );

	$('nav ul li').on('mouseover',function (){
		$('nav .slider').stop(true);
		moveSlider($(this));
	});

	$('nav ul').on('mouseleave',function(){
		var main = parseInt($(this).attr('data-primary'));
		var obj;

		//Detener todas las animaciones de ese evento
		$('nav .slider').stop(true);

		if(main>=0)
			obj = $(this).children('li').eq(main);
		else
			obj = $(this).children('li').eq(0);

		moveSlider(obj);

	});


	//EXTRA
	$('nav ul li').on('click',function(){
		$(this).parents('ul').attr('data-primary',$(this).index());
	});

})


function moveSlider(obj)
{
	var parent = obj.parents('nav').offset();
	var parentx = parent.left;
	var me = obj.offset();
	var mw = obj.width();

	var mpl = parseInt(obj.css('padding-left'));
	var mpr = parseInt(obj.css('padding-right'));

	mw += mpl + mpl;

	var mx = me.left - parentx - 10;

	$('nav .slider').animate({
		'width': mw,
		'margin-left': mx
	});
}