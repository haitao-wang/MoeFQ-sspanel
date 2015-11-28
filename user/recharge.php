<?php
require_once '_main.php';
$unDirect = true;
?>
<div class="content-wrapper">
	<div class="container">
		<section class="content-header">
			<h1>获取萌币<small></small></h1>
		</section>
		<section class="content">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">萌币充值www</h3>
				</div>
				<form id="frm1" action="../alipay/alipayapi.php" method="post" target="_blank">
				<div class="box-body">
					<p>乃账户现在有：<?php echo $oo->get_money();?> 萌币哟!</p>
					<p>输入充值哒金额v，以软妹币为单位（1RMB = 10 萌币www）：</p>
					<p>输入并点击确认后，系统将会自动重定向到支付宝充值接口。</p>
					<p>付款完成后自动到账哦~，对啦，不管PC支付还是扫码支付，一定要等到支付完成返回MoeFQ网站显示支付成功才可以呢。</p>
					
					<div class="input-group" style="width:100%;">
						<input name="amount" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'')" type="text" id="amount" placeholder="输入充值金额"/>
					</div>
					<br/>
					<input name="email" type="hidden" value="<?php echo $user_email; ?>" />
					<button id="rechargeNow" class="btn btn-success">立即充值</button>
					<br/><br/>
					<p><b>↓↓↓↓↓↓↓↓(如果乃有其他正规途径[例如活动/大量购买优惠/返利等等]得到的萌币兑换码，可以在下面兑换哟。)↓↓↓↓↓↓↓↓</b></p>
				</div>
				</form>
			</div>
			<div class="box box-warning">
				<div class="box-header">
					<h3 class="box-title">萌币兑换码vvv</h3>
				</div>
				<div class="box-body">
					<p>在下方输入萌币兑换码，然后点击激活，若验证通过，系统将自动为您充值对应面值的萌币。</p>
					<p>兑换码有相对应的面值，一般是 100/200/500/1000/2000 萌币（1RMB = 10 萌币）。通过各种活动/返利/优惠获得（加入群 472153619 了解详细信息）</p>
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
	$("#rechargeNow").click(function(){
		var amount=$("#amount").val();
		if(amount==""){
			alert('请输入充值金额！')
			return false;
		}else{
			$("#frm1").submit();
		}
	});
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