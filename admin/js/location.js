var tableRow = {};
var thisRowDataArr = [];
var oldRowDataArr = [];

$(function() {

    console.log('location js is running');
    $('.btn-primary').click(function(event) {
        tableRow = $(this).parent().parent()
        var arrayItem = []

        tableRow.has('td').each(function() {
            $('td', $(this)).each(function(index, item) {
                arrayItem.push($(item).text())
                // console.log($(item).text());
            })
        })
        arrayItem.pop()
        thisRowDataArr = arrayItem;
        console.log('this row is ' + thisRowDataArr);

        changeUpdateBoxValue();
    })

    function changeUpdateBoxValue() {
        $('option', $('#district')).each(function(index, el) {
            let clearedString = el.innerHTML.trim()
            if (clearedString == thisRowDataArr[7]) {
                console.log('el = ' + clearedString + ' thisRowDataArr = ' + thisRowDataArr[7]);
                $(el).attr('selected', 'selected');
            }
        });
        $('option', $('#category')).each(function(index, el) {
            let clearedString = el.innerHTML.trim()
            if (clearedString == thisRowDataArr[6]) {
                console.log('el = ' + clearedString + ' thisRowDataArr = ' + thisRowDataArr[6]);
                $(el).attr('selected', 'selected');
            }
        });
        $('#primary').val(thisRowDataArr[0])
        $('#cname').val(thisRowDataArr[1])
        $('#ename').val(thisRowDataArr[2])
        $('#photo').attr('src', '../img/' + thisRowDataArr[3])
        $('#description').val(thisRowDataArr[4])
        $('#edescription').val(thisRowDataArr[5])
    }

    //  popup box
    $(".modalbox").fancybox();
    $("#contact").submit(function() {
        return false;
    });
    $("#send").on("click", function() {

        $("#send").replaceWith("<em>sending...</em>");

        $.ajax({
            type: 'POST',
            url: 'sendmessage.php',
            data: $("#contact").serialize(),
            success: function(data) {
                if (data == "true") {
                    $("#contact").fadeOut("fast", function() {
                        $(this).before("<p><strong>Success! :)</strong></p>");
                        setTimeout("$.fancybox.close()", 1000);
                    });
                }else{
                    alert('Failed')
                }
            }
        });

    });
    //  popup box
})
