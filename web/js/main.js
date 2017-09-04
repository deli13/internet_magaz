document.addEventListener("DOMContentLoaded",function(){
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
    $("body").on("click","a", function(e){
        document.body.scrollTop=0;
    })
})