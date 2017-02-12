
$(function(){
    var tableRow = {};
    var thisRowDataArr = [];
    var oldRowDataArr = [];

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
        console.log('this row is '+thisRowDataArr);

        changeUpdateBoxValue();
    })

    function changeUpdateBoxValue(){
        $('option', $('#district')).each(function(index, el) {
            // console.log(el.innerHTML.trim());
            // console.log(thisRowDataArr[7]);
            if(el.innerHTML.trim() == thisRowDataArr[7]){
                // console.log('add selected');
                $(el).attr('selected', 'selected');
            }
        });
        $('option', $('#category')).each(function(index, el) {
            // console.log(el.innerHTML.trim());
            // console.log(thisRowDataArr[7]);
            if(el.innerHTML.trim() == thisRowDataArr[6]){
                // console.log('add selected');
                $(el).attr('selected', 'selected');
            }
        });
    }
})
