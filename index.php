<?php
include_once 'lib/config.php';
include_once 'header.php';
?>


<div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center pink-text"><?php echo $site_name; ?></h1>
            <div class="row center">
                <h5 class="header col s12 light">轻松科学上网   保护个人隐私</h5>
            </div>
            <div class="row center">
                <a href="user/register.php" id="download-button" class="btn-large waves-effect waves-light green">立即注册</a>
            </div>
            <br><br>
        </div>
</div>


<div class="container">
    <div class="section">

        <!--   Icon Section   -->
        <div class="row">
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
                    <h5 class="center">高速</h5>

                    <p class="light">
                        Shadowsocks节点部署在全球各个知名数据中心，线路友好、稳定。大量的高速稳定节点遍布全球，让你随时都能找到最适合的Shadowsocks节点
                    </p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
                    <h5 class="center">团队</h5>

                    <p class="light">
                       我们有着优秀的开发团队和维护团队。后台的每一处都是用心打造。而我们优秀的维护团队有着深厚的技术功底，为优质体验保驾护航
                    </p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
                    <h5 class="center">全能</h5>

                    <p class="light">
                        Shadowsocks节点支持Windows, Mac OS X,Linux,Android、iOS，甚至是OpenWRT！无论你是什么设备，只要支持Shadowsocks，你都能使用我们的服务
                    </p>
                </div>
            </div>
        </div>

    </div>
    <br><br>

    <div class="section">

    </div>
</div>
<?php  include_once 'ana.php';
       include_once 'footer.php';?>