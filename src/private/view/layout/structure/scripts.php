<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- GPT2 (Quizas algún dia GPT3 👀) -->
<script src="/src/js/j/j-gpt2-api.js"></script>

<script>
	<?php if(isset($_SESSION['user_id'])): ?>
		var user_id = <?= $_SESSION['user_id'] ?>;
		var user = <?= $_SESSION['user'] ?>;
		var password = <?= $_SESSION['user_password'] ?>
	<?php else: ?>
		var user_id = undefined;
		var user = undefined;
		var password = undefined;
	<?php endif; ?>

		function rawMessages() {
			if(user_id) getMessages(function(error, messages) {if(!error) {
				let format = '';
				messages.forEach(function(message) {
					if(message.dest == 25) {
						format += `${user}: ${message.message}\n`;
					} else {
						format += `Albert: ${message.message}\n`;
					}
				});
				$('#chat_area').val(format);
			}});
			else console.log('Inicia sesión');
		}

		function chat() {
			if(user_id) {
				$("#chat_input").prop("disabled", true);
				$("#chat_btn").prop("disabled", true);
				$("#chat_input").prop("placeholder", 'espera unos segundos');
				sendMessage($("#chat_input").val(), function(error, response) {
					if(error) console.log(error);
					else console.log(response);
					rawMessages();
					$("#chat_input").prop("disabled", false);
					$("#chat_btn").prop("disabled", false);
					$("#chat_input").prop("placeholder", 'pon algo sencillo');
				});
				$("#chat_input").val('');
			} else console.log('Inicia sesión');
		}

</script>