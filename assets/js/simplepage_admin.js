//<![CDATA[
function confirmDelete(id) {
    if (confirm('Do you confirm to delete?')) {
        document.deletesel.myId.value = id;
        document.deletesel.submit();
    }
}
// Simple list
Sortable.create(simplelist, {
    /* options */
    animation: 150,
    ghostClass: 'gradiant-gray-white-background-class' //'blue-background-class'
});

function submitOrder() {
    var items;
    var elements = document.getElementById("simplelist").getElementsByTagName("li");
    for (i = 0; i < elements.length; i++) {
        if (i !== 0) {
            items = items + ',' + elements[i].getAttribute("id");
        } else {
            items = elements[i].getAttribute("id");
        }
    }
    //alert(items);
    document.getElementById("menuOrder").value = items;

    $("#menuOrderForm").submit();
}
//]]>
