$(document).ready(function(e){
	var err = GetParameterByName("error");
	if(err === "true") {
		var form = $("#frmLogin")[0];
		form.classList.add('is-invalid');
		$('#username').addClass('is-invalid');
		$('#password').addClass('is-invalid');
		$('#btnSubmit').focus();
	}
	function GetParameterByName(param) {
		var url = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');  
		for (var i = 0; i < url.length; i++) {
			var urlparam = url[i].split('=');  
			if (urlparam[0] == param) {  
				return urlparam[1];  
			}
		}
	}
});

$('#btnSubmit').on('click', function (e) {
	var form = $('#frmLogin')[0];
	var isValid = form.checkValidity();
	if (!isValid) {
		e.preventDefault();
		e.stopPropagation();
		$('#username').removeClass('is-invalid');
		$('#password').removeClass('is-invalid');
	}
	form.classList.add('was-validated');
});

$(document).ready(function () {
	$('#dtBasicExample').DataTable();
	$('.dataTables_length').addClass('bs-select');
  });
