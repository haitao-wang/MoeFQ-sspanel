<?php
require_once '../lib/config.php';
//$code = $_GET['code'];
//$uid  = $_GET['uid'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $site_name;?> - 找回密码</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../asset/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="../asset/css/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="style-kotori.css"/>
    <script src="http://ajax.macg.moe/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        var isClick = false;
    </script>
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b><?php echo $site_name;  ?></b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">找回密码</p>

            <input type="hidden" id="code" name="code" class="form-control" value="<?php echo $code;?>" required autofocus>
            <input type="hidden" id="uid" name="uid" class="form-control" value="<?php echo $uid;?>" required autofocus>

            <div class="form-group has-feedback">
                <input id="email" name="Email" type="text" class="form-control" placeholder="Email"/>
                <span  class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <p id="userQuestion" style="display:none;">我的密保问题：？？？</p>
            <div class="form-group has-feedback" id="inputAnswer" style="display:none;">
                <input id="answer" name="answer" type="text" class="form-control" placeholder="密保问题答案"/>
            </div>
            <div class="form-group has-feedback" id="newPass" style="display:none;">
                <input id="newpassword" name="newPass" type="password" class="form-control" placeholder="新密码"/>
            </div>            
            <div class="form-group has-feedback">
                <button type="submit" id="reset" class="btn btn-primary btn-block btn-flat">重置</button>
            </div>
    
            <div id="msg-success" class="alert alert-info alert-dismissable" style="display: none;">
                <button type="button" class="close" id="ok-close" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> 成功!</h4>
                <p id="msg-success-p"></p>
            </div>
    
            <div id="msg-error" class="alert alert-warning alert-dismissable" style="display: none;">
                <button type="button" class="close" id="error-close" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> 出错了!</h4>
                <p id="msg-error-p"></p>
            </div>

        <a href="login.php" class="text-center">返回登录</a>

    </div><!-- /.login-box-body -->
<p style="text-align:center;margin-top:50px;font-size:14px;">Powered by SS-Panel / Optimized by Kotori<br/>MoeFQ <?php echo @date('Y');?> All rights reserved.</p>
</div><!-- /.login-box -->

<!-- jQuery 2.1.3 -->
<script src="../asset/js/jQuery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../asset/js/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="../asset/js/icheck.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
    // $("#msg-error").hide();
    // $("#msg-success").hide();
</script>

<script>
    $(document).ready(function(){
          function reset(){
              $("#userQuestion").html("请稍等……正在处理您的请求……");
              $.ajax({
                  type: "POST",
                  url: "_resetpwd.php",
                  dataType: "json",
                  data: {
                      answer: $("#answer").val(),
                      newpassword: $("#newpassword").val(),
                      email: $("#email").val()
                  },
                  success: function(data){
                      $("#userQuestion").html(data.msg);
                      $("#userQuestion").fadeIn();
                  },
                  error: function(){
                      $("#userQuestion").html("修改密码的时候服务器开小差惹，尝试重新提交一下吧……");
                      $("#userQuestion").fadeIn();
                  }
              });
              /*
               $.ajax({
                type:"GET",
                url:"_resetpwd.php?username="+$("#username").val()+"&email="+$("#email").val(),
                dataType:"json",
                success:function(data){
                    if(data.ok){
                        $("#msg-error").hide(100);
                        $("#msg-success").show(100);
                        $("#msg-success-p").html(data.msg);
                        window.setTimeout("location.href='index.php'", 2000);
                    }else{
                        $("#msg-error").hide(10);
                        $("#msg-error").show(100);
                        $("#msg-error-p").html(data.msg);
                    }
                },
                error:function(jqXHR){
                    $("#msg-error").hide(10);
                    $("#msg-error").show(100);
                    $("#msg-error-p").html("发生错误："+jqXHR.status);
                }
            });
            */
          }
        $("html").keydown(function(event){
            if(event.keyCode==13){
                reset();
            }
        });
        $("#reset").click(function(){
            if(isClick == true){
                reset();
            }
            else{
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "_api.php?act=getquestion",
                    data: {
                        email: $("#email").val()
                    },
                    success: function(data){
                        if(data.result == 1){
                            $("#userQuestion").html(data.question);
                            $("#userQuestion").fadeIn();
                            $("#inputAnswer").fadeIn();
                            $("#newPass").fadeIn();
                            isClick = true;
                        }
                        else{
                            $("#userQuestion").html("啊嘞，服务器返回的请求为空，这是因为您没有设置密保问题。请尝试重新请求，或联系管理员人工解决。");
                            $("#userQuestion").fadeIn();
                            isClick = false;
                        }
                    },
                    error: function(data){
                        $("#userQuestion").html("啊嘞，没有接收到服务器返回的请求哎，这可能是由于服务器宕机惹一会引起的，请尝试重新请求或联系管理员。");
                        $("#userQuestion").fadeIn();
                        isClick = false;
                    }
                });
                
            }
        });
        $("#ok-close").click(function(){
            $("#msg-success").hide(100);
        });
        $("#error-close").click(function(){
            $("#msg-error").hide(100);
        });
    })
</script>

</body>
</html>