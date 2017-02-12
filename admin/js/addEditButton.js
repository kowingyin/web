$(function(){
    $('li').mouseenter(function(){
        $(this).addClass('active')
    })
    $('li').mouseleave(function(){
        $(this).removeClass('active')
    })

})
