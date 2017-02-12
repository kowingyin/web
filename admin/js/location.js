var tableRow;
var thisRowArr;
var oldRowArr;

console.log('location js is running');

function editClick(){
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
        thisRowArr = arrayItem;
        console.log(thisRowArr);

        transfer2Form()
    })

}

function transfer2Form(){
    tableRow.text();
    console.log(tableRow.text());
}
