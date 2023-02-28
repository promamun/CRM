function cloneRow(){
    const originalRow = document.getElementById("originalRow");
    const clonedRow = originalRow.cloneNode(true);
    // Reset the input values of the cloned row
    var inputs = clonedRow.querySelectorAll("input");
    inputs.forEach(function(input) {
        input.value = "";
    });
    var otherElements = clonedRow.querySelectorAll("#totalSQft,#s_total");
    for (var j = 0; j < otherElements.length; j++) {
        otherElements[j].innerHTML = "";
    }
    const nextRow = originalRow.nextSibling;
    nextRow.parentNode.insertBefore(clonedRow, nextRow);
    toggleLastRow();
}
function toggleLastRow() {
    var lastRow = document.querySelector("#myTable tbody tr:last-child");
    var plusIcon = document.querySelector("#plusIcon");
    var closeIcon = document.querySelector("#closeIcon");
    if (lastRow){
        plusIcon.style.display='none';
        closeIcon.style.display='';
    }else {
        plusIcon.style.display='';
        closeIcon.style.display='none';
    }
}
function removedTr(This){
    This.closest('tr').remove();
    subTotalPrice()
    // console.log(This.closest('tr'))
}
function countSQft(){
    // Get all table rows
    const originalRows = document.querySelectorAll("#myTable tbody tr");
    // console.log(originalRows)
    // Loop through each table row
    originalRows.forEach(function(row) {
        // Get the input elements in the row
        var widthInput = row.querySelector('input[id="width"]');
        var heightInput = row.querySelector('input[id="height"]');
        var rateInput = row.querySelector('input[id="rate"]');
        var totalSQftInput = row.querySelector('input[id="square_ft"]');
        var total_priceInput = row.querySelector('input[id="total_price"]');

        // Calculate the multiplication result and set it as the value of the result input element
        var width = Number(widthInput.value);
        var height = Number(heightInput.value);
        var totalSq = width * height;
        totalSQftInput.value = totalSq.toFixed(2);
    });
}
function rateSum(){
    // Get all table rows
    const originalRows = document.querySelectorAll("#myTable tbody tr");
    // console.log(originalRows)
    // Loop through each table row
    originalRows.forEach(function(row) {
        // Get the input elements in the row
        var rateInput = row.querySelector('input[id="rate"]');
        var totalSQftInput = row.querySelector('input[id="square_ft"]');
        var total_priceInput = row.querySelector('input[id="total_price"]');

        // Calculate the multiplication result and set it as the value of the result input element

        var totalSq = Number(totalSQftInput.value);
        var rate = Number(rateInput.value);
        var totalPrice = totalSq * rate
        total_priceInput.value = totalPrice.toFixed(2)
        subTotalPrice()
    });
}
function subTotalPrice(){
    var total_price = document.querySelectorAll('.total_price')
    var st=0;
    for (let i=0; i<total_price.length; i++){
        st += parseInt(total_price[i].value);
    }
    document.getElementById('sub_price').value = st.toFixed(2)
}
function creditTotal(v){
    var sub_price = document.getElementById('sub_price').value
    var paid = document.getElementById('paid')
    var due = document.getElementById('due')
    var credit = parseInt(v)
    if (credit>sub_price){
        alert('Your Credit balance More Than Total Balance')
        document.getElementById('credit').value='';
        due.style.display='none';
        paid.style.display='none';
    }else {
        if (credit.toFixed(2) === sub_price){
            due.style.display='none';
            paid.style.display='';
            paid.innerHTML=credit.toFixed(2)
        }else {
            var total_due= sub_price -v ;
            due.innerHTML=total_due.toFixed(2)
            paid.style.display='none';
            due.style.display='';
        }
    }
}


