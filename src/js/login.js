$(document).ready(function() {
	$('#login-submit').click(function(e) {
		e.preventDefault();
		var $data = {
			username: $('#login-user-name').val(),
			password: $('#login-password').val()
		};
		$.ajax({
	  		method: "POST",
	  		url: "./scripts/login.php",
	  		data: $data,
			dataType: 'json',
			success: function($response) {
				if ($response.status == 'success') {
					window.location = './index.php';
				} else {
					alert($response.data);
				}
			}
		});
	});
});
