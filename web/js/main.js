document.addEventListener("DOMContentLoaded",function(){

    //Отбражение каталога
    $("body").on("mouseover",".parent",function (e) {
        var hrefParent=$(this).parent();
        $(this).toggleClass("parent");
        var data=$(this).data("id");
        var getString="id="+data;
        var ul=hrefParent.find("ul");
        if (hrefParent.find("ul").length){
        } else {
            $.post("/view/parent",getString).done(function (data) {
                var datas=$.parseJSON=data;
                hrefParent.append("<ul class='hid'></ul>");
                var list=hrefParent.find($("ul"));
                var child=datas["child"];
                var li="";
                for (i in child){
                    li+="<li><a href='/price/"+child[i]['slug']+"' class='parent' data-id='"+child[i]['id']+"'>"+child[i]['name']+"</a></li>";
                }
                list.append($(li));
            })
        }
    })
    //Перемотка на верх
    $("body").on("click","a:not(.not_up)", function(e){
        document.body.scrollTop=0;
    })
    //Изменение количества в корзине
    $('input.update-kol').on('click',function () {
        var value=$(this).val();
        var id=$(this).data('id');
        var newform=document.createElement('form');
        newform.style.display='none';
        newform.setAttribute('action','/basket/update');
        newform.setAttribute('method','get');
        var input_id=document.createElement('input');
        var input_val=document.createElement('input');
        input_id.setAttribute('name','id');
        input_val.setAttribute('name','val');
        input_id.value=id;
        input_val.value=value;
        newform.appendChild(input_id);
        newform.appendChild(input_val);
        document.body.appendChild(newform);
        newform.submit();
    })
    
    $("body").on("change","select[name='limit']",function () {
        var a=$("<form>").appendTo($("body"));
        a.append($(this))
        a.submit();
    })
})