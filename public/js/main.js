var url = "http://proyecto-laravel.test";
window.addEventListener("load", function(){

	$('.btn-like').css('cursor', 'pointer');
	$('.btn-dislike').css('cursor', 'pointer');

	function like()
	{
		$('.btn-like').unbind('click').click(function(){
			$(this).addClass('btn-dislike').removeClass('btn-like');
			$(this).attr('src', url+'/img/dos.png');

			$.ajax({
				url: url+'/like/'+$(this).data('id'),
				type: 'GET',
				success: function(response)
				{
					if(response.like)
					{
						console.log("has dado like");
					}else
					{
						console.log("Eror al dar like")
					}
				}
			});
			dislike();
		})
	}

	like();

	function dislike()
	{
		$('.btn-dislike').unbind('click').click(function(){
			$(this).addClass('btn-like').removeClass('btn-dislike');
			$(this).attr('src', url+'/img/uno.png');

			$.ajax({
				url: url+'/dislike/'+$(this).data('id'),
				type: 'GET',
				success: function(response)
				{
					if(response.like)
					{
						console.log("has dado dislike");
					}else
					{
						console.log("Eror al dar like")
					}
				}
			});
			like();
		})
	}
	dislike()

	//Buscador
	$('#buscador').submit(function(e){
	 $(this).attr('action',url+'/gente/'+$('#buscador #search').val());
	});


});