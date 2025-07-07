// $('#login').click(function(e){
// 	e.preventDefault();
// 	var login = $('#login_u').val();
// 	var password = $('#password').val();
// 	if (login == null || login == "") {
// 		$('#error').html("Maydonni to'ldiring");
// 		return false;
// 	}
// 	if (password == null || password == "") {
// 		$('#error').html("Maydonni to'ldiring");
// 		return false;
// 	}
// 	$.ajax({
// 		url: "/quiz-school-demo/main/login",
// 		type: "POST",
// 		data: "&login=" + login + "&password=" + password,
// 		success: function(res) {
// 			if (!res) return false;
// 			alert(res);
// 			// if (res == "Success") {
// 			// 	start = "<div class='title_container'><h2><span style='color: red;'>Quiz school</span> platformasiga xush kelibsiz!</h2><a href='./../index.php' class='btn btn-success'>Ishni boshlash</a></div>";
// 			// 	$('#title').html(start);
// 			// } else {
// 			// 	$('#error').html("Login yoki parolda xatolik bor!");
// 			// }
// 		}
// 	})
// })