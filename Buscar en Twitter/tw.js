$(function (){
	
	$('#finder_form').on('submit',function(e){
		
		e.preventDefault();

		var box  = $('#finder_box');
		var text = box.val();
		$.getJSON("http://search.twitter.com/search.json?callback=?",
        {
          q : text,
          include_entities: 'true',
          rpp : 99
        },function(tweets) {
         
         //Resetear
          $('#tweets').text('');

          //Recorrer tweet a tweet devuelto y agegarlo
          $.each(tweets.results, function(i,tweet){

          	/*
				Para mas informacion sobre los objetos y sus atributos que
				se devuelven por cada "tweet", visitar: https://dev.twitter.com/docs/api/1/get/search
          	*/

          	var pp = tweet.profile_image_url.replace('_normal','');
            var t = $('<article class="tweet">'
            			+'<div class="capsutweet">'
            				+'<a href="//twitter.com/'+tweet.from_user+'" target="_blank" class="user_link">'
            						+'<div class="user_pic"><img src="'+pp+'" alt=""/></div>'
            					+'</a>'
            					+'<div class="user_text">'
            						+'<p>'+tweet.text+'</p>'
            					+'</div>'
            					+'<div class="user_data">'
            						+'<a href="//twitter.com/'+tweet.from_user+'" target="_blank" class="user_link">'
            							+'<span class="username">'+tweet.from_user+'</span>'
            						+'</a>&nbsp;&nbsp;&nbsp;&nbsp;'
            						+'<a href="//twitter.com/'+tweet.from_user+'/status/'+tweet.id_str+'" target="_blank">'
            							+'<div class="time_info">'
            								+'<time class="datetime">'+tweet.created_at+'</time>'
            							+'</div>'
            						+'</a>'
            					+'</div>'
            				+'</div><hr class="septweet"/>'
            			+'</article>');

           	t.appendTo('#tweets');			                
          });


            $(".tweet .user_pic img").load(function (){
            	var me = $(this);

            	//Obtener medidas elementales
				var uia = me.width();
				var uib = me.height();

				var boxX = me.parent().width();
				var boxY = me.parent().height();

				var nH = uib * boxX / uia;
				var nW = boxX;

				//Comprobar si al ajutar la altura es menor
				if(nH < boxY)
				{
					nH = me.css('height',boxY+'px').height();
					nW = uia * boxY / uib;
				}

				me.css({
					"width":nW,
					"left":"50%",
					"margin-left": (boxX-nW)/2,
					"margin-top" : (boxY-nH)/2
				}); // Me.css 

			}); // Fin de función que carga imágenes


        }); // Fin getJSON

	});// Fin evento 'submit'

}); //Fin jQuery