<?php
require_once '_main.php';
error_reporting(E_ALL);
//获得流量信息
if($oo->get_transfer()<1000000)
{
    $transfers=0;}else{ $transfers = $oo->get_transfer();

    }
//计算流量并保留2位小数
    $all_transfer = $oo->get_transfer_enable()/$togb;
    $unused_transfer =  $oo->unused_transfer()/$togb;
    $used_100 = $oo->get_transfer()/$oo->get_transfer_enable();
    $used_100 = round($used_100,2);
    $used_100 = $used_100*100;
//计算流量并保留2位小数
    $transfers = $transfers/$tomb;
    $transfers = round($transfers,2);
    $all_transfer = round($all_transfer,2);
    $unused_transfer = round($unused_transfer,2);
//最后在线时间
    $unix_time = $oo->get_last_unix_time();
    ?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="font-family:Microsoft Yahei;">
                仪表盘
                <small>Dashboard</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- START PROGRESS BARS -->
            <div class="row">
                <div class="col-md-6">

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">公告&FAQ</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body"> 
                            <div id="notice">
                                <div class="callout callout-warning"><?php echo $ko->getOption('notice'); ?></div>
                                <div class="callout callout-success"><?php echo $ko->getOption('notice','subvalue'); ?></div>
                            </div>
                         <div></div>
                     </div><!-- /.box-body -->
                 </div><!-- /.box -->
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">流量使用情况</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                       <p> 您已经用惹： <?php echo $transfers."MB";?></p><p> 还剩下这些： <?php echo  $unused_transfer."GB";?></p> <p> 本月一共有： <?php echo $all_transfer ."GB";?> </p> 
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $used_100; ?>%">
                                <span class="sr-only">Transfer</span>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col (left) -->



            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">签到获取流量</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <p> 22小时内可以签到一次。</p>
                        <?php  if($oo->is_able_to_check_in())  { ?>
                        <p id="checkin-btn"> <button id="checkin" class="btn btn-success  btn-flat">签到</button></p>
                        <?php  }else{ ?>
                        <p><a class="btn btn-success btn-flat disabled" href="#">不能签到</a> </p>
                        <?php  } ?>
                        <p id="checkin-msg" ></p>
                        <p>上次签到时间：<code><?php echo date('Y-m-d H:i:s',$oo->get_last_check_in_time());?></code></p>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Shadowsocks 连接信息</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <p> 端口：<code id="port"><?php echo $oo->get_port();?></code> </p>
                        <p> 密码：<code id="password"><?php echo $oo->get_pass();?></code> </p>
                        <p> 套餐：<span class="label label-info"> <?php echo $oo->get_plan();?> </span> </p>
                        <p> 最后使用时间：<code><?php echo date('Y-m-d H:i:s',$unix_time);  ?></code> </p>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col (right) -->
        </div><!-- /.row -->
        <!-- END PROGRESS BARS -->
    </section><!-- /.content -->
    </div>
</div><!-- /.content-wrapper -->
<?php
require_once '_footer.php'; ?>

<script>
    $(document).ready(function(){
        $("#checkin").click(function(){
            $.ajax({
                type:"GET",
                url:"_checkin.php",
                dataType:"json",
                success:function(data){
                    $("#checkin-msg").html(data.msg);
                    $("#checkin-btn").hide();
                },
                error:function(jqXHR){
                    alert("发生错误："+jqXHR.status);
                }
            })
        })
    })

</script>

