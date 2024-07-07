var categories = [];
var products = [];

function loadCategories() {
    $.get('http://localhost/?action=getCategories', function (response) {
        categories = JSON.parse(response);
        //feltoltjuk a selectet
        let html = '';
        let filterhtml = '<option value="">Osszes</option>';
        categories.forEach(category => {
            html += `<div class='kategoria' onClick='showModal()'>
                        <img src='Icons/${category.icon}'/>
                        <div class='kategoria_nev'>${category.name}</div>
                    </div>`;
            filterhtml += `<option value="${category.id}">${category.name}</option>`;
        });
        $("#categories").html(html);
        $("#filterby").html(filterhtml);
    });
}

function closeModal() {
    $("#modal").addClass('hidden');
    $("#modal").removeClass('edit');
}

//a modal feldobasa, kitoltes nelkul, csak a kategoriat toltjuk ki
function showModal() { 
    //megjelenitjuk a modalt
    $("#modal").removeClass('hidden');
    $("#modal").removeClass('edit');
    $("#id").val('');
    $("#name").val('');
    $("#expiry").val('');
    $("#note").val('');
    //elore kitoltjuk a kategoriat
    const selectValue = $("#categories").val();
    //beleirjuk egy inputba a select erteket
    $("#category").val(selectValue);
    //rajzoljuk ki a kategoria ikonjat is
    const icon = getCategoryIcon(selectValue);
    $("#modalCategory").html(icon);
}

function getCategoryIcon(id) {
    let html = 'Nincs ikon';
    categories.forEach(category => {
        if(category.id == id) {
            html = `<img src="Icons/${category.icon}"/>`;
        }
    });
    return html;
}

loadCategories();

