<?php
require_once '../lib/config.php';
require_once '_check.php';
$id = $_GET['id'];
$node = new \Ss\Node\NodeInfo($id);
$server =  $node->Server();
$method = $node->Method();
$pass = $oo->get_pass();
$port = $oo->get_port();
$nodeType = $node->Type();
$role = $ko->kotoriNeedInfo('role',$uid);
$userPermission = $ko->getUserPermission($role);
$ssurl =  $method.":".$pass."@".$server.":".$port;
$ssqr = "ss://".base64_encode($ssurl);
if($userPermission >= $nodeType):
?>
<p>ss://<?php echo $ssurl;?></p>
<p id="ssqr_text" ><?php echo $ssqr;?></p>
<div align="center">
    <div id="qrcode"></div>
</div>
<script src="../asset/js/jQuery.min.js"></script>
<script src="../asset/js/jquery.qrcode.min.js"></script>
<script>
    jQuery('#qrcode').qrcode("<?php echo $ssqr;?>");
</script>
<?php else: ?>
	<p>Interesting: Permission Denied.</p>
<?php endif;?>




