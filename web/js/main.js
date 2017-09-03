document.addEventListener("DOMContentLoaded",function(){
    $("body").on("mouseover",".parent",function (e) {
        //e.preventDefault();
        var hrefParent=$(this).parent();
        var data=$(this).data("id");
        var getString="id="+data;
        var ul=hrefParent.find("ul");
        if (hrefParent.find("ul").length){
        //    ul.toggle();
        } else {
            $.post("/view/parent",getString).done(function (data) {
                var datas=$.parseJSON=data;
                hrefParent.append("<ul class='hid'></ul>");
                var list=hrefParent.find($("ul"));
                var child=datas["child"];
                for (i in child){
                    list.append("<li><a href='/price/"+child[i]['slug']+"' class='parent' data-id='"+child[i]['id']+"'>"+child[i]['name']+"</a></li>");
                }
            })
        }


    })
})