<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">

<!--        <div class="pull-left image">
            <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>        -->
        <div class="pull-right btn-group">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="float: right;margin-top: 10px;">
                <span class="caret" style="color:#fff"></span>
            </a>
            <ul class="dropdown-menu">                        
                <li><a href="#" id="lnk-perfil" style="color:#859FAE; display: block; text-align:right;margin: 10px 0;"><i class="fa fa-user" style="margin-right: 5px;"></i>Meu Perfil</a></li>
                <li><a href="#" id="lnk-sair" style="color:#859FAE; display: block; text-align:right"><i class="fa fa-toggle-off" style="margin-right: 5px;"></i>Fazer Logout</a></li>
            </ul>
        </div>
        <div class="pull-left info" style="left:0; position: relative;">
            <p><a href="usuario"><?php echo $_SESSION["usuario"]->nome_usuario; ?></a></p>
            <a href="usuario"><?php echo $_SESSION["usuario"]->papel; ?></a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">        
        <li class="active">
            <a href="projeto/<?php echo $_SESSION["projeto"]->slug_projeto; ?>/dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="projeto/<?php echo $_SESSION["projeto"]->slug_projeto; ?>/product-backlog">
                <i class="fa fa-database"></i> <span>Product Backlog</span>
            </a>
        </li>
        <li>
            <a href="projeto/<?php echo $_SESSION["projeto"]->slug_projeto; ?>/sprint">
                <i class="fa fa-refresh"></i> <span>Sprint</span>
            </a>
        </li>        
        <!-- <li>
            <a href="projeto/<?php #echo $id_projeto;  ?>/product-backlog">
                <i class="fa fa-archive"></i> <span>Reviews</span>
            </a>
        </li>
        <li>
            <a href="projeto/<?php #echo $id_projeto;  ?>/product-backlog">
                <i class="fa fa-wrench"></i> <span>Retrospectives</span>
            </a>
        </li>  -->       
        <li class="treeview">
            <a href="#">
                <i class="fa fa-users"></i> <span>Stakeholders</span>
            </a>
            <ul class="treeview-menu">
                <li><a href="projeto/<?php echo $_SESSION["projeto"]->slug_projeto; ?>/scrum-team"> <span>Scrum Team</span></a></li>
                <li><a href="projeto/<?php echo $_SESSION["projeto"]->slug_projeto; ?>/clientes"> <span>Clientes</span></a></li>
            </ul>
        </li>
        <li>
            <a href="projeto/<?php echo $_SESSION["projeto"]->slug_projeto; ?>/mensagens">
                <i class="fa fa-envelope"></i> <span>Mensagens</span>
                <small class="label pull-right bg-yellow">12</small>
            </a>
        </li>        
    </ul>
</section>
