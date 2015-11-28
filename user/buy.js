$("#LogOff").click(function(){
    if(confirm("请再次确认您需要注销您的VIP身份，我们将回收您的VIP端口并分配新的端口，您仍然可以享受我们的免费服务。\n\n注销之后您仍然可以再次开通。一旦您点击确认，将没有后续操作，请仔细斟酌。")){
        $.ajax({
            type: "POST",
            url: "_api.php?act=portrecycle",
            dataType: "json",
            async: false,
            data:{
                uid: '<?php echo $uid;?>',
            },
            success: function(data){
                if(data.code == 0){
                    alert(data.msg);
                    window.location.href="index.php";
                }
                else{
                    alert(data.msg);
                }
            },
            error: function(jqXHR){
                alert("Failed:"+jqXHR.status);
            }
        });
    }
    else{}
});

$("#openVIP1Month").click(function(){
    if(confirm("主银，确实要开通VIP 1月付套餐吗？该套餐的价格为10元/月哦！点击确认后会立刻结算，没有后续操作辣！\n\n如果您之前不是VIP1，开通之后会覆盖当前的身份，并为您分配新的Shadowsoscks连接端口，否则将会直接为您续费。")){
        
        $.ajax({
            type: "POST",
            url: "_api.php?act=openvip",
            dataType: "json",
            data: {
                uid: "<?php echo $uid;?>",
                type: "vip1",
                paymethod: "month",
                confirm: "confirm"
            },
            success: function(data){
                if(data.code == 0){
                    alert(data.msg);
                    window.location.href="index.php";
                }
                else{
                    alert("开通过程中出现了问题，这可能是身份验证失败导致的，请联系管理员，或者重新登录后再试一次。");
                }
            },
            error: function(){
                alert("啊嘞，与服务器通讯出现了错误，主银再试一下下吧……");
            }
        });
        
    }
    else{}
});

$("#openVIP2Month").click(function(){
    if(confirm("主银，确实要开通VIP 2月付套餐吗？该套餐的价格为20元/月哦！点击确认后会立刻结算，没有后续操作辣！\n\n如果您之前不是VIP1，开通之后会覆盖当前的身份，并为您分配新的Shadowsoscks连接端口，否则将会直接为您续费。")){
        
        $.ajax({
            type: "POST",
            url: "_api.php?act=openvip",
            dataType: "json",
            data: {
                uid: "<?php echo $uid;?>",
                type: "vip2",
                paymethod: "month",
                confirm: "confirm"
            },
            success: function(data){
                if(data.code == 0){
                    alert(data.msg);
                    window.location.href="index.php";
                }
                else{
                    alert("开通过程中出现了问题，这可能是身份验证失败导致的，请联系管理员，或者重新登录后再试一次。");
                }
            },
            error: function(){
                alert("啊嘞，与服务器通讯出现了错误，主银再试一下下吧……");
            }
        });
        
    }
    else{}
});

$("#openVIP1Year").click(function(){
    if(confirm("主银，确实要开通VIP 1年付套餐吗？该套餐的价格为100元/年哦！点击确认后会立刻结算，没有后续操作辣！\n\n如果您之前不是VIP1，开通之后会覆盖当前的身份，并为您分配新的Shadowsoscks连接端口，否则将会直接为您续费。")){
        
        $.ajax({
            type: "POST",
            url: "_api.php?act=openvip",
            dataType: "json",
            data: {
                uid: "<?php echo $uid;?>",
                type: "vip1",
                paymethod: "year",
                confirm: "confirm"
            },
            success: function(data){
                if(data.code == 0){
                    alert(data.msg);
                    window.location.href="index.php";
                }
                else{
                    alert("开通过程中出现了问题，这可能是身份验证失败导致的，请联系管理员，或者重新登录后再试一次。");
                }
            },
            error: function(){
                alert("啊嘞，与服务器通讯出现了错误，主银再试一下下吧……");
            }
        });
        
    }
    else{}
});

$("#openVIP2Year").click(function(){
    if(confirm("主银，确实要开通VIP 2年付套餐吗？该套餐的价格为200元/年哦！点击确认后会立刻结算，没有后续操作辣！\n\n如果您之前不是VIP1，开通之后会覆盖当前的身份，并为您分配新的Shadowsoscks连接端口，否则将会直接为您续费。")){
        
        $.ajax({
            type: "POST",
            url: "_api.php?act=openvip",
            dataType: "json",
            data: {
                uid: "<?php echo $uid;?>",
                type: "vip2",
                paymethod: "year",
                confirm: "confirm"
            },
            success: function(data){
                if(data.code == 0){
                    alert(data.msg);
                    window.location.href="index.php";
                }
                else{
                    alert("开通过程中出现了问题，这可能是身份验证失败导致的，请联系管理员，或者重新登录后再试一次。");
                }
            },
            error: function(){
                alert("啊嘞，与服务器通讯出现了错误，主银再试一下下吧……");
            }
        });
        
    }
    else{}
});