<?php
require_once '_main.php';
$unDirect = true;
?>
<div class="content-wrapper">
    <div class="container">
        <section class="content-header">
            <h1>
                价格表
                <small>Price List</small>
            </h1>
            <br/>
        </section>
        <section class="content">
            <?php if($ko->kotoriNeedInfo('role',$uid)=='vip1' || $ko->kotoriNeedInfo('role',$uid)=='vip2'): 
                  if($ko->kotoriNeedInfo('role_timeout',$uid)==0):?>
                <div class="callout callout-danger">
                    <p>嗨，您的 <?php echo $U->UserRole(); ?> 已经到期，为了不影响您正常使用我们提供服务，请您及时续费，如果您不续费则无法继续享受VIP的服务呢……</p>
                    <p>如果您不想再续费，请<a href="#" id="LogOff">点击这里注销您的VIP身份</a>，之后您还能够使用我们的免费服务。</p>
                </div>
            <?php endif; endif;?>
            <h4 style="margin:10px;color:#fff;font-family:Microsoft Yahei;">您当前的等级是：<?php echo $U->UserRole(); ?> / 距离身份到期还有 <?php echo $ko->kotoriNeedInfo('role_timeout',$uid);?> 天。点击下面的开通可以续费。 / <a href="paycode.php">前往充值请点击这里</a></h4>
            <div class="row">
                
                <div class="col-md-6">
                    
                    <!--Free-->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">免费套餐</h3>
                        </div>
                        <div class="box-body">
                            <ul>
                                <li>可享受米国、11区的 4 个免费节点</li>
                                <li>每个月 6 GB的流量</li>
                                <li>可冲浪、视频、游戏，禁止下载</li>
                            </ul>
                            <br/>
                            <p>价格：<code> 0 RMB </code> </p>
                            <p style="text-align:right;">无需开通</p>
                        </div>
                    </div>
                    
                    <!--VIP 1-->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">VIP 1 尊享套餐</h3>
                        </div>
                        <div class="box-body">
                            <ul>
                                <li>除了4个免费节点外，可专享VIP 1 的专属优化节点</li>
                                <li>每个月多达 50 GB 的流量</li>
                                <li>更加稳定、快速的节点，告别拥挤！</li>
                                <li>可冲浪、视频、游戏、下载，在TOS范围内不受限制。</li>
                            </ul>
                            <br/>
                            <p>价格： <code> 100 萌币/月 1000 萌币/年 </code></p>
                            <p style="text-align:right;"><a href="#" id="openVIP1Month" class="btn btn-success">开通月付</a> <a href="#" id="openVIP1Year" class="btn btn-success">开通年付</a></p>
                        </div>
                    </div>
                    
                </div><!--col-md-6-->
                
                <div class="col-md-6">
                    
                    <!--VIP2-->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">VIP 2 豪华套餐</h3>
                        </div>
                        <div class="box-body">
                            <ul>
                                <li>尊享 MoeFQ 的全部节点！包括我们千辛万苦投入全副精力的特殊优化节点！</li>
                                <li>每个月多达 200 GB 的流量！</li>
                                <li>十分稳定、快速的节点，告别拥挤！</li>
                                <li>可冲浪、视频、游戏、下载，在TOS范围内不受限制</li>
                            </ul>
                            <br/>
                            <p>价格： <code> 200 萌币/月 2000 萌币/年 </code></p>
                            <p style="text-align:right;"><a href="#" id="openVIP2Month" class="btn btn-success">开通月付</a> <a href="#" id="openVIP2Year" class="btn btn-success">开通年付</a></p>
                        </div>
                    </div>
                    
                    <!--赞助线路-->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">赞助用户专享套餐</h3>
                        </div>
                        <div class="box-body">
                            <ul>
                                <li>尊享 MoeFQ 的全部节点！此外您可以额外得到一条私人专属节点！</li>
                                <li>每个月多达 500 GB 的流量！（专属节点路不受流量限制）</li>
                                <li>个人节点只属于您，您拥有全部支配权，尊享全部的带宽！</li>
                                <li>可冲浪、视频、游戏、下载，在TOS范围内以及使用私人专属节点不受限制！</li>
                            </ul>
                            <br/>
                            <p>价格： <code> 600 萌币/月 6000 萌币/年 </code></p>
                            <p style="text-align:right;">需要人工开通，请加群 472153619 商议具体事宜。</p>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </section>
    </div>
</div>
<?php
require_once '_footer.php'; 
?>
<script>
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
    if(confirm("主银，确实要开通VIP 1月付套餐吗？该套餐的价格为100 萌币/月哦！点击确认后会立刻结算，没有后续操作辣！\n\n如果您之前不是VIP1，开通之后会覆盖当前的身份，并为您分配新的Shadowsoscks连接端口，否则将会直接为您续费。")){
        
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
                else if(data.code == 3){
                    alert(data.msg);
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
    if(confirm("主银，确实要开通VIP 2月付套餐吗？该套餐的价格为200 萌币/月哦！点击确认后会立刻结算，没有后续操作辣！\n\n如果您之前不是VIP1，开通之后会覆盖当前的身份，并为您分配新的Shadowsoscks连接端口，否则将会直接为您续费。")){
        
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
                else if(data.code == 3){
                    alert(data.msg);
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
    if(confirm("主银，确实要开通VIP 1年付套餐吗？该套餐的价格为1000 萌币/年哦！点击确认后会立刻结算，没有后续操作辣！\n\n如果您之前不是VIP1，开通之后会覆盖当前的身份，并为您分配新的Shadowsoscks连接端口，否则将会直接为您续费。")){
        
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
                else if(data.code == 3){
                    alert(data.msg);
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
    if(confirm("主银，确实要开通VIP 2年付套餐吗？该套餐的价格为2000 萌币/年哦！点击确认后会立刻结算，没有后续操作辣！\n\n如果您之前不是VIP1，开通之后会覆盖当前的身份，并为您分配新的Shadowsoscks连接端口，否则将会直接为您续费。")){
        
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
                else if(data.code == 3){
                    alert(data.msg);
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
</script>