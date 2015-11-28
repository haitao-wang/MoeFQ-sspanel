<?php if(empty($ko->kotoriNeedInfo('question',$uid)) || empty($ko->kotoriNeedInfo('answer',$uid))): ?>
    <div id="question-banner" style="width:100%;height:100%;position:fixed;top:0;z-index:1001;background:rgba(51,51,51,0.9);">
        <div class="container">
        <div class="box box-primary" style="z-index:999;top:20%;margin:60px auto;">
            <div class="box-header">
                <h3 class="box-title">请更新你在 MoeFQ 的密保问题</h3>
            </div>
            <div class="box-body">
                <p id="question-info">为了提高 MoeFQ 每位用户的信息安全性，MoeFQ 开发组新增了密保问题的机制来保证用户的账号安全，请更新你在 MoeFQ 的密保问题：</p>
                <div class="form-group">
                    <p><input type="text" id="question" name="question" class="form-control" placeholder="请输入一个你喜欢的密保问题"></p>
                </div>
                <div class="form-group">
                    <p><input type="text" id="answer" name="answer" class="form-control" placeholder="请输入密保问题的答案"></p>
                </div>
                <p><button id="submitMe" class="btn btn-info">提交</button></p>
            </div>
            </div>
        </div>
        <script>
            $("#submitMe").click(function(){
                $.ajax({
                    type:"POST",
                    url:"_api.php?act=question",
                    dataType:"json",
                    data:{
                        question: $("#question").val(),
                        answer: $("#answer").val(),
                        uid: <?php echo $uid; ?>
                    },
                    success:function(){
                        $("#question-info").html("您的密保问题已经更新，感谢您的配合。").delay(1000);
                        $("#question-banner").fadeOut(1000);
                    },
                    error:function(){
                        $("#question-info").html("您的密保问题已经更新(wu)，感谢您的配合。");
                        $("#question-banner").fadeOut(1000);                        
                    }
                });
            });
        </script>
    </div>
<?php endif; ?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
         PHP处理时间 : <?php
        $Runtime->Stop();
        echo $Runtime->SpendTime()."ms";
        ?>
    </div>
    &copy;<?php echo @date('Y'); ?> MoeFQ 保留所有权利 | 由 SSPanel 驱动 | 由 MoeFQ 团队 二次开发 | 请阅读我们的 <a href="tos.php">服务条款  </a>
</footer>
</div><!-- ./wrapper -->
<?php
include_once '../ana.php';
?>

<!-- jQuery 2.1.3 -->
<script src="../asset/js/jQuery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../asset/js/bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../asset/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../asset/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../asset/js/app.min.js" type="text/javascript"></script>
</body>
</html>
<script>
  $(function(){
        $.ajax({
        url: "https://hitokoto.imim.pw/?encode=jsc",
        dataType: "jsonp",
        async: true,
        jsonp: "callback",
        jsonpCallback: "hitokoto",
        success: function(result) {
            $('.container').append("<p style='text-align:center;color:#fff;'>" + result.hitokoto + "</p>")
        },
        error: function() {}
    });
  });
</script>
<?php if($ko->kotoriNeedInfo('role',$uid)=='vip1' || $ko->kotoriNeedInfo('role',$uid)=='vip2'):
if($ko->kotoriNeedInfo('role_timeout',$uid)==0 && !isset($unDirect)):?>
<script>window.location.href="price.php";</script>
<?php endif;endif;?>