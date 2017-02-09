$('button:#btnLogin').click(function() {
	$('#formLogin').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: '../login.php',
        data: $(this).serialize(),
        success: function(data) {
            if (data === 'Login') {
                window.location = '/user-page.php';
            } else {
                alert('Invalid Credentials');
            }
        }
    });
});
});
