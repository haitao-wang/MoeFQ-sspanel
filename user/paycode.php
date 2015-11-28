<?php
require_once '_main.php';
$unDirect = true;
?>
<div class="content-wrapper">
	<div class="container">
		<section class="content-header">
			<h1>付款码激活 <small>Activate my PayCode</small></h1>
		</section>
		<section class="content">
			<div class="box box-warning">
				<div class="box-header">
					<h3 class="box-title">激活付款码</h3>
				</div>
				<div class="box-body">
					<p>在下方输入您获取的付款码，然后点击激活，若验证通过，系统将自动为您充值对应面值的萌币。</p>
					<p>付款码有相对应的面值，一般是 100/200/500/1000/2000 萌币（1RMB = 10 萌币）。可以联系管理员购买付款码（加入群429764970了解详细信息）</p>
					<div class="input-group" style="width:100%;">
						<input class="form-control" type="text" id="payCode-activate" placeholder="输入您获取的付款码ww"/>
					</div>
					<br/>
					<button id="activateNow" class="btn btn-success">立刻激活</button>
				</div>
			</div>
		</section>
	</div>
</div>
<?php
require_once '_footer.php'; 
?>
<script type="text/javascript">
	$("#activateNow").click(function(){
		$.ajax({
			type: "POST",
			url: "_api.php?act=paycode",
			dataType: "json",
			data: {
				uid: "<?php echo $uid;?>",
				code: $("#payCode-activate").val(),
				confirm: "confirm"
			},
			success: function(data){
				alert("付款码激活成功辣，本次激活的付款码面值为 "+data.size+" 萌币，您现在的余额为 "+data.extra+" 萌币w");
				window.location.href="index.php";
			},
			error: function(){
				alert("抱歉，在激活的过程中没有接受到服务器娘的返回值嘞……检查一下输入的付款码对不对有没有带空格啥的啦……也可能是服务器娘宕机惹，稍等一会就好~");
			}
		});
	});

</script>