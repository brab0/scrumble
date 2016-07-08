<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
<!--        <div class="pull-left image">
            <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>-->
        <div class="pull-left info" style="left:0; position: relative;">
            <p style="margin-top: 10px;"><?php echo $_SESSION["usuario"]->nome_usuario; ?></p>            
        </div>
    </div>    
    <ul class="sidebar-menu">        
        <li class="active">
            <a href="usuario/dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <!-- <li>
            <a href="leitor-de-faturas/product-backlog">
                <i class="fa fa-database"></i> <span>Projetos</span>
            </a>
        </li>
        <li>
            <a href="leitor-de-faturas/product-backlog">
                <i class="fa fa-database"></i> <span>Estórias e Tarefas</span>
            </a>
        </li>               
        <li>
          <a href="leitor-de-faturas/">
            <i class="fa fa-envelope"></i> <span>Mensagens</span>
            <small class="label pull-right bg-yellow">12</small>
          </a>
        </li>    -->     
    </ul>
</section>