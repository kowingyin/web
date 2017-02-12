$(function(){
    $('tr:not(:first-child)').append('<td><button class="btn btn-primary">Edit</button></td>');
    $('li').mouseenter(function(){
        $(this).addClass('active')
    })
    $('li').mouseleave(function(){
        $(this).removeClass('active')
    })

})
