	<script type="text/javascript">  
	$(document).ready( function(){
		$("#contactform").attr('action', '../includes/pear_mail/add_message.php?a=1');//necessary to prevent spambots when using no javascript
		//$(".no_js").hide();
	
		// PearMail + Fancy Captcha + Validator code. 	
		$("#contactform").validate({
			submitHandler : function(){
				if($('[name="captcha"]').val()){
					$.ajax({
						url: $("#contactform").attr('action'),
						data: $("#contactform").serialize(),
						type: 'post',
						beforeSend: function(){
								$('.loader').fadeIn(300);//show loader
							},
						success: function(data){
								if(data==1){
									$('.overlay').delay(300).fadeIn(300);//show overlay background
									$('.alert_wrap').delay(300).fadeIn(300);//show alert_box
									$('.msgsuccess').delay(300).fadeIn(300);//show succes block
								}
								else{
									$('.overlay').delay(300).fadeIn(300);//show overlay background
									$('.alert_wrap').delay(300).fadeIn(300);//show alert_box
									$('.msgerror').delay(300).fadeIn(300);//show error block
								}
							},
						complete : function(){
								$('.loader').fadeOut(300);//remove loader
								$('.reset').val('');//reset form values
								$('[name="captcha"]').remove();//reset captcha value
								$(function() {
									$(".ajax-fc-container").captcha({
										borderColor: "",  
										captchaDir: "../scripts/captcha",  
										url: "../scripts/captcha/captcha.php",  
										formId: "contactform",  
										text: "Verify that you are a human,drag the<br />blue block onto the grey block.",
										items: Array("one", "two", "three", "four", "five")								});
								});//reinitialize captcha
							}
					});
				}
				else{alert("You must drag the blue block onto the grey block.");}
				return false;
			}
		});
		$(function() {
			$(".ajax-fc-container").captcha({
				borderColor: "",  
				captchaDir: "../scripts/captcha",  
				url: "../scripts/captcha/captcha.php",  
				formId: "contactform",  
				text: "Verify that you are a human,drag the<br />blue block onto the grey block.",
				items: Array("one", "two", "three", "four", "five")		
			});
		});
		
		
	function set_overlay_height(){
		var page_height = $(document).outerHeight();
		$('.overlay').css('height', page_height+'px');
	}
	set_overlay_height();
	$('.close_alert, .overlay').click(function(){
		$('.overlay').fadeOut(300);
		$('.alert_wrap').fadeOut(300);
		return false;
	});
			
		
		
	});
	</script>
