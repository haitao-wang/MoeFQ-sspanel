<?php
require_once '_main.php';
$node = new Ss\Node\Node();
?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            节点一览
            <small>Node View</small>
        </h1>
        <br/>
    </section>
    <ul class="nav nav-tabs user-node-header" style="margin:0 10px ;">
        <li class="pull-left active">
            <a href="#free-node" data-toggle="tab" aria-expanded="true">免费节点</a>
        </li>
        <li class="pull-left">
            <a href="#vip-node-1" data-toggle="tab" aria-expanded="false">VIP1 节点</a>
        </li>
        <li class="pull-left">
            <a href="#vip-node-2" data-toggle="tab" aria-expanded="false">VIP2 节点</a>
        </li>
    </ul>
    <!-- Main content -->
    <section class="content">
        <!-- START PROGRESS BARS -->
        <div class="row tab-content">
            <div id="free-node" class="tab-pane fade in active col-md-12">
                <div class="box box-solid">
                    <div class="box-header">
                        <i class="fa fa-th-list"></i>
                        <h3 class="box-title">免费节点</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="callout callout-warning">
                            <h4>注意!</h4>
                            <p>免费节点只受到流量限制，请不要在任何地方公开本节点的地址，或者您的账号信息！<br/>每个人都有独一无二的端口和连接密码，如果您公开节点信息，您将会有连带责任。<br/>如果你爱MoeFQ，请和我们一起保护她。</p>
                        </div>
                        <div class="row">
                            <?php
                            $node0 = $node->NodesArray(0);
                            foreach($node0 as $row){
                                ?>
                                <div class="col-md-6">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs pull-right">
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                    操作 <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="node_json.php?id=<?php echo $row['id']; ?>">配置文件</a></li>
                                                    <li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="node_qr.php?id=<?php echo $row['id']; ?>">二维码</a></li>
                                                </ul>
                                            </li>
                                            <li class="pull-left header"><i class="fa fa-angle-right"></i> <?php echo $row['node_name']; ?></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1-1">
                                                <p> <a class="btn btn-xs bg-purple btn-flat margin" href="#">地址:</a> <code><?php echo $row['node_server']; ?></code>
                                                    <a class="btn btn-xs bg-orange btn-flat margin" href="#"><?php echo $row['node_status']; ?></a>
                                                    <a class="btn btn-xs bg-green btn-flat margin" href="#"><?php echo $row['node_method']; ?></a>
                                                </p>
                                                <p> <?php echo $row['node_info']; ?></p>
                                            </div><!-- /.tab-pane -->
                                        </div><!-- /.tab-content -->
                                    </div><!-- nav-tabs-custom -->
                                </div>
                                <?php }?>
                            </div><!-- /.box-body -->
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col (left) -->

                <div id="vip-node-1" class="tab-pane fade col-md-12">
                    <div class="box box-solid">
                        <div class="box-header">
                            <i class="fa fa-code"></i>
                            <h3 class="box-title">VIP1 节点</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php
                            if($U->UserRoleNode(1)): ?>
                            <div class="callout callout-success">
                                <h4>注意!</h4>
                                <p>这是VIP 1 节点，只有VIP 1 或更高等级的用户才能看到。<br/>请不要随意公开本站的节点，避免被GFW认证哦。</p>
                            </div>
                            <div class="row">
                                <?php
                                $node1 = $node->NodesArray(1);
                                foreach($node1 as $row){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="dropdown">
                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                        操作 <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="node_json.php?id=<?php echo $row['id']; ?>">配置文件</a></li>
                                                        <li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="node_qr.php?id=<?php echo $row['id']; ?>">二维码</a></li>
                                                    </ul>
                                                </li>
                                                <li class="pull-left header"><i class="fa fa-angle-right"></i> <?php echo $row['node_name']; ?></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1-1">
                                                    <p> <a class="btn btn-xs bg-purple btn-flat margin" href="#">地址:</a> <code><?php echo $row['node_server']; ?></code>
                                                        <a class="btn btn-xs bg-orange btn-flat margin" href="#"><?php echo $row['node_status']; ?></a>
                                                        <a class="btn btn-xs bg-green btn-flat margin" href="#"><?php echo $row['node_method']; ?></a>
                                                    </p>
                                                    <p> <?php echo $row['node_info']; ?></p>
                                                </div><!-- /.tab-pane -->
                                            </div><!-- /.tab-content -->
                                        </div><!-- nav-tabs-custom -->
                                    </div>
                                    <?php }?>
                                   </div>
                                <?php else: ?> 
                                <div class="callout callout-warning">
                                    <h4>啊嘞，没有权限哦……</h4>
                                    <p>抱歉，这是VIP 1 节点，只有VIP 1 或更高等级的用户才可以使用和阅览。<br/>VIP用户将能够使用更多节点，并且速度更快，线路更稳定。<br/>如果您有需要，请联系管理员购买VIP。</p>
                                </div>
                            <?php endif;?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col (right) -->
            

            <div id="vip-node-2" class="tab-pane fade col-md-12">
                <div class="box box-solid">
                    <div class="box-header">
                        <i class="fa fa-code"></i>
                        <h3 class="box-title">VIP 2 节点</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        if($U->UserRoleNode(2)): ?>
                        <div class="callout callout-success">
                            <h4>注意!</h4>
                            <p>这是VIP 2 节点，只有 VIP 2 或 管理员 用户才能看到。<br/>请不要随意公开本站的节点，避免被GFW认证哦。</p>
                        </div>
                        <div class="row">
                            <?php
                            $node1 = $node->NodesArray(2);
                            foreach($node1 as $row){
                                ?>
                                <div class="col-md-6">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs pull-right">
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                    操作 <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="node_json.php?id=<?php echo $row['id']; ?>">配置文件</a></li>
                                                    <li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="node_qr.php?id=<?php echo $row['id']; ?>">二维码</a></li>
                                                </ul>
                                            </li>
                                            <li class="pull-left header"><i class="fa fa-angle-right"></i> <?php echo $row['node_name']; ?></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1-1">
                                                <p> <a class="btn btn-xs bg-purple btn-flat margin" href="#">地址:</a> <code><?php echo $row['node_server']; ?></code>
                                                    <a class="btn btn-xs bg-orange btn-flat margin" href="#"><?php echo $row['node_status']; ?></a>
                                                    <a class="btn btn-xs bg-green btn-flat margin" href="#"><?php echo $row['node_method']; ?></a>
                                                </p>
                                                <p> <?php echo $row['node_info']; ?></p>
                                            </div><!-- /.tab-pane -->
                                        </div><!-- /.tab-content -->
                                    </div><!-- nav-tabs-custom -->
                                </div>
                                <?php }?>
                            <?php else: ?> 
                            <div class="callout callout-warning">
                                <h4>啊嘞，没有权限哦……</h4>
                                <p>抱歉，这是VIP 2 节点，只有VIP 2 或更高等级的用户才可以使用和阅览。<br/>VIP用户将能够使用更多节点，并且速度更快，线路更稳定。<br/>如果您有需要，请联系管理员购买或升级VIP。</p>
                            </div>
                        <?php endif;?>
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
