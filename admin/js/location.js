$tableRow = '';
$thisRowArr = {};

console.log('location js is running');

function tr2Form() {
    $('.btn-primary').click(function(event) {
      
        $tableRow = $(this).parent().parent()
        var arrayItem = []
        var i = 0
        $tableRow.has('td').each(function() {
            $('td', $(this)).each(function(index, item) {
                arrayItem[i] = $(item).text()
                    ++i;
                console.log($(item).text());
            })
        })
        arrayItem.pop()
        $thisRowArr = arrayItem;
        console.log($thisRowArr);
    })
}
