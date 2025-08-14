<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$main_menu = $this->customnavigation->getData();
//var_dump($main_menu);
if(isset($main_menu['error']) && $main_menu['error'] == true) {
	die($main_menu['error_message']);
}
?>

<style>
/* Stackoverflow preview fix, please ignore */
.navbar-nav {
    flex-direction: row;
}

.nav-link {
    padding-right: .5rem !important;
    padding-left: .5rem !important;
}

/* Fixes dropdown menus placed on the right side */
.ml-auto .dropdown-menu {
    left: auto !important;
    right: 0px;
}

.sublink {
    padding-left: 40px;
}
</style>
<!--
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <?php
      echo $main_menu['home'];
    ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php
        foreach($main_menu['left'] as $data){
          echo $data;
        }
      ?>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php
        foreach($main_menu['right'] as $data){
          echo $data;
        }
      ?>

                <li class="nav-item">
                    <a class="nav-link" href=" <?php echo base_url() . 'logout'; ?>"><i class="fas fa-power-off"></i>
                        ODJAVA</a>
                </li>

            </ul>

        </div>
    </nav>
-->

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <!-- top menu -->
    <div class="form-inline mr-auto">
        <!-- left top menu -->
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"><i
                        class="fas fa-bars"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i class="fas fa-expand"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- right top menu -->
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?php echo base_url(); ?>/assets/img/user-tmp.png" class="user-img-radious-style">
                <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">
                    <?php echo $this->session->userdata('title').$this->session->userdata('user'); ?>
                </div>
                <a href="<?php echo base_url() . 'main/profile/'.$this->session->userdata('user_uid'); ?>"
                    class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profil
                </a>
                <!-- 
                <a href="javascript:void(0)"
                    class="settingPanelToggle dropdown-item has-icon d-none d-md-block d-lg-block">
                    <i class="fas fa-cog"></i> Settings
                </a>
                -->
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url() . 'logout'; ?>" id="ext" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Odjava
                </a>
            </div>
        </li>
    </ul>
</nav>

<div class="main-sidebar sidebar-style-2" tabindex="1" style="overflow: hidden; outline: none;">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url();?>">
                <span class="logo-name">HEALTH DOCS</span>
                <!-- <img alt="image" src="static/img/logo-skypos.svg" class="header-logo" /> -->
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">IZBOR</li>

            <li>
                <a href="<?php echo base_url() . 'users/edit/'.$this->session->userdata('user_uid'); ?>"
                    class="nav-link"><i class="fas fa-user"></i>
                    <span><?php echo $this->session->userdata('title').$this->session->userdata('user'); ?></span>
                </a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-cog"></i>
                    <span>Podešavanja</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?php echo base_url('settings'); ?>">
                            <span class="sublink">Opšti podaci</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?php echo base_url('institution'); ?>">
                            <span class="sublink">Podaci o ustanovi</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="<?php echo base_url('users'); ?>" class="nav-link"><i class="fas fa-users"></i>
                    <span>Korisnici</span></a>
            </li>

            <li>
                <a href="<?php echo base_url('main/ik'); ?>" class="nav-link"><i class="fab fa-accessible-icon"></i>
                    <span>Invalidska komisija</span>
                </a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file"></i>
                    <span>Obrasci za oružje</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?php echo base_url('main/oruzje/1'); ?>">
                            <span class="sublink">Obrazac 1</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?php echo base_url('main/oruzje/4'); ?>">
                            <span class="sublink">Obrazac 4</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>


<!--

<div class="settingSidebar">
<a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i></a> 
<div class="settingSidebar-body ps-container ps-theme-default">
    <div class=" fade show _active">
        <div class="setting-panel-header">Setting Panel
        </div>
        <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Select Layout</h6>
            <div class="selectgroup layout-color w-50">
                <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input select-layout">
                    <span class="selectgroup-button">Dark</span>
                </label>
            </div>
        </div>
        <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Sidebar Color</h6>
            <div class="selectgroup selectgroup-pills sidebar-color">
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                        data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                        data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                </label>
            </div>
        </div>
        <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Color Theme</h6>
            <div class="theme-setting-options">
                <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                        <div class="white"></div>
                    </li>
                    <li title="cyan">
                        <div class="cyan"></div>
                    </li>
                    <li title="black">
                        <div class="black"></div>
                    </li>
                    <li title="purple">
                        <div class="purple"></div>
                    </li>
                    <li title="orange">
                        <div class="orange"></div>
                    </li>
                    <li title="green">
                        <div class="green"></div>
                    </li>
                    <li title="red">
                        <div class="red"></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="p-15 border-bottom">
            <div class="theme-setting-options">
                <label>
                    <span class="control-label p-r-20">Mini Sidebar</span>
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                        id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                </label>
            </div>
        </div>
        <div class="p-15 border-bottom">
            <div class="theme-setting-options">
                <div class="disk-server-setting m-b-20">
                    <p>Disk Space</p>
                    <div class="sidebar-progress">
                        <div class="progress" data-height="5">
                            <div class="progress-bar l-bg-green" role="progressbar" data-width="80%" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="progress-description">
                            <small>26% remaining</small>
                        </span>
                    </div>
                </div>
                <div class="disk-server-setting">
                    <p>Server Load</p>
                    <div class="sidebar-progress">
                        <div class="progress" data-height="5">
                            <div class="progress-bar l-bg-orange" role="progressbar" data-width="58%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="progress-description">
                            <small>Highly Loaded</small>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
            <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                <i class="fas fa-undo"></i> Restore Default
            </a>
        </div>
    </div>
</div>
</div>
</div>

      -->