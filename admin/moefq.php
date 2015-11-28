<?php
require_once '_main.php';
$Users = new Ss\User\User();
$ko = new Kotori();
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1 style="font-family:Microsoft Yahei;">MoeFQ 后台设置 <small>MoeFQ Options</small></h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">首页公告修改</h3>
					</div>
					<div class="box-body">
						<p>在这里可以修改首页的两条公告。</p>
						<div class="input-group">
							<span class="input-group-addon">公告1</span>
							<input type="text" name="notice-1" class="form-control" id="notice-1" aria-describedby="notice-1" value="<?php echo $ko->getOption('notice'); ?>">	
						</div>
						<div class="input-group">
							<span class="input-group-addon">公告2</span>
							<input type="text" name="notice-2" class="form-control" id="notice-2" aria-describedby="notice-2" value="<?php echo $ko->getOption('notice','subvalue'); ?>">
						</div>						
						<br/>
						<button id="submit-notice" class="btn btn-primary">提交</button>
					</div>
				</div>
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">生成付款码</h3>
					</div>
					<div class="box-body">
						<p>在这里可以批量生成付款码。</p>
						<div class="input-group" style="width:100%;" >
							<input class="form-control" style="width:100%;" id="paycode-number" type="text" placeholder="生成的付款码的数量，必须是一个整数。"/>
						</div>
						<div class="input-group" style="width:100%;" >
							<input class="form-control" style="width:100%;"  id="paycode-size" type="text" placeholder="生成的付款码的面值，以萌币为单位，如100/200/500/1000/2000..."/>
						</div>
						<div class="input-group" style="width:100%;" >
							<input class="form-control"  style="width:100%;" id="paycode-salt" type="text" placeholder="生成付款码所用的加密的盐，可以乱打不要放空，不要与之前重复。"/>
						</div>
						<br/>
						<button id="submit-paycode" class="btn btn-success">生成</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<footer class="main-footer">
	<div class="pull-right hidden-xs">
		Processed in：<?php
		$Runtime->Stop();
		echo $Runtime->SpendTime()."ms";
		?>
	</div>
	MoeFQ Private SSPanel Plugined by Kotori
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
	$("#submit-notice").click(function(){
		$.ajax({
			type:"POST",
			url:"_api.php?act=notice",
			dataType:"json",
			async:true,
			data:{
				noticeOne:$("#notice-1").val(),
				noticeTwo:$("#notice-2").val()
			},
			success:function(data){
				alert("成功地修改了公告！");
			},
			error:function(jqXHR){
				alert("成功地修改了公告！（wu）");
			}
		})
	});

	$("#submit-paycode").click(function(){
		$.ajax({
			type: "POST",
			url: "_api.php?act=paycode",
			dataType: "json",
			data: {
				number: $("#paycode-number").val(),
				size: $("#paycode-size").val(),
				salt: $("#paycode-salt").val()
			},
			success: function(data){
				alert("付款码生成成功，本次一共生成面值为"+data.size+"萌币的付款码"+data.number+"个。");
			},
			error: function(){
				alert("付款码生成失败，或许是与服务器的通讯出现异常，或者是您没有完整填写以上信息。");
			}
		});
	});
</script>