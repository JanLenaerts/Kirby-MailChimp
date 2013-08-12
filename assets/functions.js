$(document).ready(function() {

	$('#subscribe').submit(function()
	{
		var action = $('#subscribe').attr('action');
		$.ajax({
			url: action,
			type: 'POST',
			data: {
				email: $('#address').val(),
				fname: $('#fname').val(),
				lname: $('#lname').val()
			},
			success: function(data){
				$('#result').html(data).css('color', 'green');
			},
			error: function() {
				$('#result').html('Sorry, an error occurred.').css('color', 'red');
			}
		});	

		return false;						
	});

});