(function ($) {
    let timeout;
    $(".cod-order-form , .cod_product_order_form").on("keyup", function () {
        clearTimeout(timeout); 
        console.log(caoData.delay)
        timeout = setTimeout(() => {
            var full_name = $("input[name=name]").val();
            var phone = $("input[name=phone]").val();
            var product_name = $("input[name=product_title]").val();
            var order_id = parseInt($("input[name=cao-id]").val());
            if(phone != '' && isNaN(order_id)){
                $.ajax({
                    type:'POST',
                    url:caoData.ajaxurl ,
                    data:{
                        action:'order_abandon_check',
                        method:'add',
                        phone,
                        product_name,
                        full_name
                    },
                    success:function(res){
                        var cod_order_id = document.createElement("input");
                        cod_order_id.setAttribute("name","cao-id")
                        cod_order_id.setAttribute("value",res)
                        cod_order_id.setAttribute("type","hidden")
                        $(".cao-form, .cod_product_order_form").append(cod_order_id)
                    }
                })
            }else if(!isNaN(order_id)){
                $.ajax({
                    type:'POST',
                    url:caoData.ajaxurl ,
                    data:{
                        action:'order_abandon_check',
                        method:'edit',
                        phone,
                        product_name,
                        full_name,
                        order_id
                    },
                })
            }
            
        }, caoData.delay);
      });
      $(".cod-order-form , .cod_product_order_form").on("submit", function(){
        var order_id = parseInt($("input[name=cao-id]").val());
        if(!isNaN(order_id)){
            $.ajax({
                type:'POST',
                url:caoData.ajaxurl ,
                data:{
                    action:'order_abandon_check',
                    method:'delete',
                    order_id
                },
            })
        }
        
      })

   
})(jQuery);