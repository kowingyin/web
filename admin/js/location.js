$innerContent = '';

function tr2Form(){
    $('.btn-primary').click(function(event) {
    	$innerHTML = $(this).innerHTML();
		console.log($innerContent);
    });
}
