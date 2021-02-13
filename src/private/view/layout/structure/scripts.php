<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- GPT2 (Quizas algún dia GPT3 👀) -->
<script src="/src/js/j/j-gpt2-api.js"></script>

<script>
	<?php if(isset($_SESSION['user_id'])): ?>
		const user_id = <?= _SESSION['user_id'] ?>;
		const user = <?= _SESSION['user'] ?>;
	<?php else: ?>
		const user_id = undefined;
		const user = undefined;
	<?php endif; ?>

		function rawMessages() {
			if(user_id) getMessages(function(error, messages) {if(!error) {
				let format = '';
				messages.forEach(function(message) {
					if(message.id == 25) {
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
				$("#chat_input").prop("readonly", true);
				$("#chat_input").prop("placeholder", 'espera unos segundos');
				sendMessage($("#chat_input").val(), function(error, response) {
					if(error) console.log(error);
					else console.log(response);
					rawMessages();
					$("#chat_input").prop("readonly", false);
					$("#chat_input").prop("placeholder", 'pon algo sencillo');
				});
			} else console.log('Inicia sesión');
		}

</script>