
$(document).ready(function(){
	/* click to animate the registration div */
	$('#registration a').click(function(event){
		event.preventDefault();
		if($('#registration').hasClass('open') == false) {
			/* open the drawer and add the class */
			$('#registration').animate({
				'top': '0px'
			}, 500, function(){
				$('#registration').addClass('open');
			});
		} else {
			/* close the drawer and remove the class */
			$('#registration').animate({
				'top': '-40px' 
			}, 500, function(){
				$('#registration').removeClass('open');
			});
		}
	});
	
   /* submit e-mail address */
    $('form[name="registration"]').submit(function(e) {
    	e.preventDefault();
		/* Check to see if this is a valid email address */
		var regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	   	var inputEmail = $('input[name="userEMail"]').val();
	   	/* perform the test */
	   	var resultEmail = regexEmail.test(inputEmail);
		if (!resultEmail) {
			/* clear the form */
    		$('form[name="registration"] input').val('');
    		/* place a message in the placeholder */
    		$('input[name="userEMail"]').attr('placeholder', 'Invalid email address!');
		} else {
			/* submit the form */
			var formAction = $(this).attr('action');
			var formData = $(this).serialize();
			$.post(
				formAction,
				formData,
				function(data){
					$('form[name="registration"] input').val('');
					switch(data) {
					case "1":
						$('input[name="userEMail"]').attr('placeholder', 'Thank you!');
						break;
					case "1062":
						/* duplicate key error */
						$('input[name="userEMail"]').attr('placeholder', 'Already subscribed.');
						break;
					default:
						$('input[name="userEMail"]').attr('placeholder', 'Please resubmit!');
						break;
					}
			});
		}
    });
})
