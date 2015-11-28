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
if($userPermission >= $nodeType):
?>
{
"server":"<?php echo $server; ?>",
"server_port":<?php echo $port; ?>,
"local_port":1080,
"password":"<?php echo $pass; ?>",
"timeout":600,
"method":"<?php echo $method; ?>"
}
<?php else: ?>
	<p>Interesting: Permission Denied.</p>
<?php endif;?>




