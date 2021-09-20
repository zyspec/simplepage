<{*
<style>
    body.dragging, body.dragging * {
        cursor: move !important;
    }

    .dragged {
        position: absolute;
        opacity: 0.5;
        z-index: 2000;
    }
    #sortable{
        width: 200px;
        background-color:#D8D4E2;
        border:1px solid #6B4C86;
    }
    #sortable li{
        list-style: none;
        font-size: 12px;
        line-height: 150%;
        margin: 1px;
        padding: 3px 5px;
    }
    .sortableitem{
        background-color:#BEDEFE;
        border:1px solid #7EA6B2;
    }
    .sortableactive{
        background-color:#D1E6EC;
        border:1px solid #7EA6B2;
    }
    .sortablehover{
        background-color:#D8D4E2;
        border:1px solid #6B4C86;
    }
    .sorthelper{
        background-color:#D8EDCF;
        border:1px solid #7EA6B2;
    }
</style>

<style>
    .blue-background-class{
        background-color: #E1E9FB;
    }
    .gray-background-class{
        background-color: lightgray;
    }
    .ghostwhite-background-class{
        background-color: ghostwhite;
    }
    .gradiant-gray-white-background-class{
        background-image: linear-gradient(ghostwhite, darkgray)
    }
    #simplelist li{
        list-style: none;
        font-size: 1.2em;
        line-height: 150%;
        margin: 1px;
        padding: 3px 5px;
    }
    .list-group-item{
        border:1px solid #7EA6B2;
    }
</style>
*}>
<link rel="stylesheet" src="../assets/css/module_admin.css"></link>
<!-- Used to send delete ID start -->
<form name="deletesel" action="<{$thisUrl}>" method="post">
    <input name="op" type="hidden" value="delete">
    <input name="myId" type="hidden" value="">
</form>
<{*
<script>
//<![CDATA[
    function confirmDelete(id) {
        if (confirm('Do you confirm to delete?')) {
            document.deletesel.myId.value = id;
            document.deletesel.submit();
        }
    }
//]]>
</script>
*}>
<!-- Used to send delete ID end -->

<div>
    <h3><{$smarty.const._AD_SIMPLEPAGE_MENUITEM}></h3>
    <table class="outer center pad3 border bspacing1">
        <thead>
        <tr>
            <th class="center width10">#</th>
            <th class="center"><{$smarty.const._AD_SIMPLEPAGE_TITLE}></th>
            <th class="center"><{$smarty.const._AD_SIMPLEPAGE_LINK}></th>
            <th class="center width10"><{$smarty.const._AD_SIMPLEPAGE_ACTION}></th>
        </tr>
        </thead>
<{if $itemsArray}>
        <tbody>
<{foreach from=$itemsArray item=menuitem}>
        <tr class="<{cycle values="odd,even"}>">
            <td class="center"><{$menuitem.menuitemId}></td>
            <td class="left"><{$menuitem.title}></td>
            <td class="center"><{$menuitem.adminLink}></td>
            <td class="center">
                    <a href="<{$thisUrl}>?op=edit&amp;menuitemId=<{$menuitem.menuitemId}>"><{$smarty.const._EDIT}></a> |
                    <a href="#" id="<{$menuitem.menuitemId}>" onclick="confirmDelete(this.id);"><{$smarty.const._DELETE}></a>
            </td>
        </tr>
<{/foreach}>
<{else}>
        <tr><td colspan="4" class="even center"><{$smarty.const._AD_SIMPLEPAGE_NOPAGE}></td></tr>
<{/if}>
        </tbody>
    </table>
</div>

<{if $itemsArray}>
<div class="center marg10 pad10">
<fieldset class="center width20 floatcenter1">
    <h3><{$smarty.const._AD_SIMPLEPAGE_SORTTHEMENU}></h3>
    <p><{$smarty.const._AD_SIMPLEPAGE_DRAP_AND_DROP_THE_MENUITEM}></p>
    <div class="center">
        <ul id="simplelist" class="list-group">
            <{foreach from=$itemsArray item=menuitem}>
            <li class="list-group-item" id="<{$menuitem.menuitemId}>"><{$menuitem.title}></li>
            <{/foreach}>
        </ul>
        <form id="menuOrderForm" action="<{$thisUrl}>" method="post">
            <input name="op" type="hidden" value="sort">
            <input name="menuOrder" id="menuOrder" type="hidden" value="1">
            <input name="orderSubmit" type="button" id="orderSubmit" value="<{$smarty.const._AD_SIMPLEPAGE_SUBMITNEWORDER}>" onclick="submitOrder();"/>
        </form>
    </div>
</fieldset>
</div>
<{/if}>

<div class="pager"><{$pager}></div>
<script src="../assets/js/Sortable.min.js"></script>
<script src="../assets/js/simplepage_admin.js"></script>
<{*
<script>
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
</script>
*}>