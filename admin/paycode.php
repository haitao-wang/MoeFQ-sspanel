<?php
require_once '_main.php';
$Users = new Ss\User\User();
$ko = new Kotori();
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1 style="font-family:Microsoft Yahei;">MoeFQ 付款码 <small>MoeFQ PayCode List</small></h1>
	</section>
	<section class="content">
		<div class="box box-success">
			<div class="box-body">
				<p>在这里可以看到已经生成的付款码。</p>
				<table class="table">
					<thead>
						<th>序号</th>
						<th>付款码</th>
						<th>面值</th>
					</thead>
					<tbody>
						<?php 
						$id = 1;
						$data = $ko->db()->query("SELECT * FROM moefq_code");
						while($payCode = mysqli_fetch_array($data,MYSQLI_ASSOC)){
							echo '<tr>';
							echo '<td>'.$id.'</td>';
							$id = $id+1;
							echo '<td>'.$payCode['code'].'</td>';
							echo '<td>'.$payCode['size'].'</td>';
							echo '</tr>';
						}
						?>
					</tbody>
				</table>
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
