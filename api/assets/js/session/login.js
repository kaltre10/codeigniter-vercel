(function($){
	$("#form_login").submit(function(ev){
		$('#alert').html("");
		$.ajax({
			url: 'Login/validate',
			type: 'POST',
			data: $(this).serialize(),
			success: function(err){
				var json = JSON.parse(err);
				window.location.replace(json.url);
			},
			error: function(xhr){
				if(xhr.status == 400){
					$("#email > input").removeClass('is-invalid');
					$("#email > input").addClass('is-valid');
					$("#password > input").removeClass('is-invalid');
					$("#password > input").addClass('is-valid');
					var json = JSON.parse(xhr.responseText);
					if (json.email.length != 0 ) {
						$("#email > div ").html(json.email);
						$("#email > input").addClass('is-invalid');
					}
					if (json.password.length != 0 ) {
						$("#password > div ").html(json.password);
						$("#password > input").addClass('is-invalid');
					}
				}else if (xhr.status == 401){
					$("#email > input").removeClass('is-invalid');
					$("#password > input").removeClass('is-invalid');
					$("#email > input").removeClass('is-valid');
					$("#password > input").removeClass('is-valid');
					var json = JSON.parse(xhr.responseText);
					// console.log(json.msg);
					$('#alert').html('<div class="alert alert-danger" role="alert">'+ json.msg +'</div>');
				}
			},
		});
		ev.preventDefault();
	});
})(jQuery)