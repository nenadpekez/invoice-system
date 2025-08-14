$(function(){
	$('select[name=country]').change(function(){
		$('input[name=country_inp]').val($(this).find(':selected').val());
	});
});

function form_unlock_reset(target,target_label,arr_fields) {
	if (target.id=='form_unlock') {
		//console.log("lock");
		target.id 	= 'form_lock';
		target.type = 'reset';
		//$(target_label).html('<i class="fa fa-unlock"></i>');
		$(target).html('<i class="fa fa-unlock"></i>');
		//$(target_label).prev().attr('class','icon icon-unlock');
		for (var i = 0; i < arr_fields.length; i++) { 
			$('#'+arr_fields[i]).prop('disabled',false).removeAttr('disabled'); 
			$('.'+arr_fields[i]).prop('disabled',false).removeAttr('disabled'); 
		}
		$('#btn_save').attr('style','display:inline');
		$('#btn_cancel').attr('style','display:inline');
	} else {
		//console.log("unlock");
		target.id 	= 'form_unlock';
		target.type = 'button';
		//$(target_label).html('<i class="fas fa-lock"></i>');
		$(target).html('<i class="fas fa-lock"></i>');
		//$(target_label).prev().attr('class','icon icon-lock');
		for (var i = 0; i < arr_fields.length; i++) { 
			$('#'+arr_fields[i]).prop('disabled',true); 
			$('.'+arr_fields[i]).prop('disabled',true); 
		}
		$('#btn_save').attr('style','display:none');
		$('#btn_cancel').attr('style','display:none');
		document.forms[0].reset();
	}
}
function package_select(pkg_id) {
	if ($("#packet1").prop('disabled')==true) return;
	$("#packet1").attr("checked","");
	$("#img1").fadeTo(0, 0.5);
	$("#packet2").attr("checked","");
	$("#img2").fadeTo(0, 0.5);
	$("#packet3").attr("checked","");
	$("#img3").fadeTo(0, 0.5);
	$("#packet"+pkg_id).attr("checked","checked");
	$("input:radio[id='packet"+pkg_id+"']").trigger('click');
	$("#img"+pkg_id).fadeTo(0, 1);
}
$(document).ready(function() {
	$("#img1").fadeTo(0, 0.5);
	$("#img2").fadeTo(0, 0.5);
	$("#img3").fadeTo(0, 0.5);
	if ($("#packet1").attr("checked")=="checked") {
		$("#img1").fadeTo(0, 1);
	} else if ($("#packet2").attr("checked")=="checked") {
		$("#img2").fadeTo(0, 1);
	} else {
		$("#img3").fadeTo(0, 1);
	}
});

$(document).ready(function() {
    $("#show_hide_password #eye-btn").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
			$('#show_hide_password i').removeClass( "fa-eye" );
			$('#show_hide_password i').attr("title", $('#show_hide_password i').data("show") );
			
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
			$('#show_hide_password i').addClass( "fa-eye" );
			$('#show_hide_password i').attr("title", $('#show_hide_password i').data("hide") );
        }
    });
});



$(document).on('click', '#user_add .btn_save_pass', function(e) {
	var pass1 = $('#password').val();
	var pass2 = $('#password2').val();
	var chk = true;

	if (pass1 == ''){
		chk = false;
	}
	if (pass2 == ''){
		chk = false;
	}
	if (pass1 != pass2){
		chk = false;
	}
	
	if (chk == false) {
		e.preventDefault();
		//console.log('pass NOT OK');
		alert("Password and re-typed password are not the same, please check!");
	}
});

$(document).on('click', '#user-form .btn_save_pass', function(e) {
	var pass1 = $('#prs_password').val();
	var pass2 = $('#prs_password2').val();
	var chk = true;
	var pass_length = 0;
	var url = location.search;
	var myParam = /a=([^&]+)/.exec(url)[1];
	//console.log(myParam);

	if (pass1 == ''){
		chk = false;
	}
	if (pass2 == ''){
		chk = false;
	}
	if (pass1 != pass2){
		chk = false;
	}
	if( (myParam == 'edit') && (pass1 == '') && (pass2 == '') ){
		chk = false;
	}
	if (chk == false) {
		e.preventDefault();
		//console.log('pass NOT OK');
		alert("Password and re-typed password are empty or not the same, please check!");
	} else {
		if(pass1.length < 8){
			e.preventDefault();
			//console.log('pass NOT OK');
			alert("Password length must be 7 characters or more!");
		}
	}
});
