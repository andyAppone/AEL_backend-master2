<?php
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
?>
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            
            <li class="nav-item start <?php if ($controller == 'site') { ?> active <?php } ?>">
                <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl(''); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?php if ($controller == 'usertype') { ?> active <?php } ?>">
                <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('usertype'); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">User Type</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?php if($controller == 'user' || $controller == 'consumers') { ?> active open <?php } ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">User Management</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start <?php if ($controller == 'user') { ?> active <?php } ?>">
                        <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('user'); ?>" class="nav-link">
                            <i class="icon-home"></i>
                            <span class="title">Staff Members</span>
                        </a>
                    </li>
                    <li class="nav-item start <?php if ($controller == 'consumers') { ?> active <?php } ?>">
                        <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('consumers'); ?>" class="nav-link">
                            <i class="icon-home"></i>
                            <span class="title">Consumers</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start <?php if($controller == 'pm' || $controller == 'ecall') { ?> active open <?php } ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Service Management</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start <?php if ($controller == 'pm') { ?> active <?php } ?>">
                        <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('pm'); ?>" class="nav-link">
                            <i class="icon-home"></i>
                            <span class="title">PM Services</span>
                        </a>
                    </li>
                    <li class="nav-item start <?php if ($controller == 'ecall') { ?> active <?php } ?>">
                        <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('ecall'); ?>" class="nav-link">
                            <i class="icon-home"></i>
                            <span class="title">Ecall Services</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start <?php if ($controller == 'lift') { ?> active <?php } ?>">
                <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('lift'); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Lift Management</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?php if ($controller == 'checklist') { ?> active <?php } ?>">
                <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('checklist'); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Checklist Management</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?php if ($controller == 'messages') { ?> active <?php } ?>">
                <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('messages'); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Messages Management</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?php if($controller == 'documents' || $controller == 'categorydoc') { ?> active open <?php } ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Documents Management</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start <?php if ($controller == 'categorydoc') { ?> active <?php } ?>">
                        <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('categorydoc'); ?>" class="nav-link">
                            <i class="icon-home"></i>
                            <span class="title">Category Management</span>
                        </a>
                    </li>
                    <li class="nav-item start <?php if ($controller == 'documents') { ?> active <?php } ?>">
                        <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('documents'); ?>" class="nav-link">
                            <i class="icon-home"></i>
                            <span class="title">Doc Management</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start <?php if ($controller == 'leave') { ?> active <?php } ?>">
                <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('leave'); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Leave Management</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?php if ($controller == 'content') { ?> active <?php } ?>">
                <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('content'); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Content Management</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?php if ($controller == 'attendance') { ?> active <?php } ?>">
                <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('attendance'); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Attendance Management</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?php if ($controller == 'pettycash') { ?> active <?php } ?>">
                <a href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('pettycash'); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Pettycash Management</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->









