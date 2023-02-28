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

    var fastRow = document.querySelector("table tbody tr:last-child");
    var closeIcon = document.querySelector("#closeIcon");
    if (fastRow){
        closeIcon.style.display='';
    }else {
        closeIcon.style.display='';
    }
}
function removedTr(This){
    This.closest('tr').remove();
    // console.log(This.closest('tr'))
}
function typeData(value){
    var opt = "";
    var opts = "";
    var ops = "";
    axios.get('/customer-bank-data/'+ value)
        .then(response =>{
            // console.log(response.data)
            if (value==='Customer'){
                opt += "<option class='text-center'>Select Customer</option>";
                for (var i=0; i<response.data.length; i++){
                    opt += "<option value='"+ response.data[i].id +"'>"+ response.data[i].name + '-' + response.data[i].company_name +"</option>";
                }
                document.getElementById('profile').innerHTML= opt;
            } if(value==='Supplier'){
                ops += "<option class='text-center'>Select Supplier</option>";
                for (var l=0; l<response.data.length; l++){
                    ops += "<option value='"+ response.data[l].id +"'>"+ response.data[l].name + '-' + response.data[l].company_name +"</option>";
                }
                document.getElementById('profile').innerHTML= ops;
            } if(value==='Bank') {
                opts += "<option class='text-center'>Select Bank</option>";
                for (var j=0; j<response.data.length; j++){
                    opts += "<option value='"+ response.data[j].id +"'>"+ response.data[j].bank_name + '-' + response.data[j].account_name +"</option>";
                }
                document.getElementById('profile').innerHTML= opts;
            }
        }).catch(error =>{
        console.log(error)
    })
}


