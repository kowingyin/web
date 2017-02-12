var tableRow;
var thisRowDataArr;
var oldRowDataArr;

console.log('location js is running');

$(function(){
    $('.btn-primary').click(function(event) {
        tableRow = $(this).parent().parent()
        var arrayItem = []

        tableRow.has('td').each(function() {
            $('td', $(this)).each(function(index, item) {
                arrayItem.push($(item).text())
                console.log($(item).text());
            })
        })
        arrayItem.pop()
        thisRowDataArr = arrayItem;
        console.log('this row is '+thisRowDataArr);
    })

})
