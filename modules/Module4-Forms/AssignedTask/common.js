$(function(){
	$('#survey').submit(function(){
		var errors = [];
		
		if($("input[name='name']").val() == ""){
			errors.push("Please enter your name.");
			$('#name').addClass('error');
		}
		else{
			$('#name').removeClass('error');
		}
		
		if(!$("input[name='question[0]']:checked").length){
			errors.push("Please answer question 1.");
			$('#question0').addClass('error');
		}
		else{
			$('#question0').removeClass('error');
		}
		
		if(!$("input[name='question[1]']:checked").length){
			errors.push("Please answer question 2.");
			$('#question1').addClass('error');
		}
		else{
			$('#question1').removeClass('error');
		}
		
		if(!$("input[name='question[2]']:checked").length){
			errors.push("Please answer question 3.");
			$('#question2').addClass('error');
		}
		else{
			$('#question2').removeClass('error');
		}
		
		if(errors.length != 0){
			alert(errors.join('\n'));
			return false;
		}
	});
});