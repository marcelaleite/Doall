<?php
function footer()
{
    return '<footer class="page-footer roxo">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Contatos</h5>
                    <p class="white-text text-lighten-4">Martina: (47)98871-1014 <br>
                        Rian: (47)99678-8302</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Instituição</h5>
                    <ul>
                        <li><a class="white-text text-lighten-3" href="http://www.ifc-riodosul.edu.br/site/" target="_blank">IFC - <i>campus</i> Rio do Sul, <br> Unidade Urbana</a></li>
                    </ul>
                </div>
               
            </div>
        </div>
        <div class="footer-copyright" style="background: #73417f">
            <div class="container ">
                <a class="white-text right" >© <?php echo date("Y"); ?> M&R</a>
            </div>
        </div>
    </footer>';
}
function header1()
{
    return '<header>
        <nav class="roxo">
            <div class="nav-wrapper" >
                <a href="#" class="brand-logo center">Doall</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul  id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="info.php">Pagina Inicial</a>
                    <li><a href="cadastro.php">Cadastro</a></li>
                   <li><a class="modal-trigger" href="#login">Login</a></li>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li><a href="info.php">Pagina Inicial</a></li>
            <li><a href="cadastro.php">Cadastro</a></li>
             <li><a class="modal-trigger" href="#login">Login</a></li>
        </ul>
        
    </header>';
}
function header2()
{
    $final = '<header>
    <!-- Dropdown Structure -->
    <ul class="dropdown-content" id="conta">
        <li><a href="conta.php"><i class="material-icons">person</i>Conta</a></li>
        <li><a href="acaoLogin.php?acao=logoof"><i class="material-icons">exit_to_app</i>Sair</a></li>
    </ul>
    <nav class="roxo">
        <div class="nav-wrapper" >
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="left" >
                 <a class="dropdown-trigger hide-on-med-and-down" data-target="conta" style="height: 4.000em;">
                    <li class="" style="height: 1.000em;"> <img class="circle " style="margin-top: 0.6em;"  src="';

    $final .= $_SESSION['foto'] != "" ? $_SESSION['foto'] : "img/user_default.png";
    $final .= '"width="45"></li>
                    <li>&NegativeMediumSpace; Olá, ' . $_SESSION["nome"] . '</li></a>
            </ul>
            <a href="index.php" class="brand-logo center">Doall</a>
        </div>
    </nav>
     <ul class="sidenav" id="mobile-demo">
         <div class=" row col s12 roxo white-text" style = "">
             <div class="col s2 offset-s2">
       <li> <img class="circle " style="m a rgin-top: 1em;" src="';
       $final.= $_SESSION['foto'] != "" ? $_SESSION['foto'] : "img/user_default.png";
       $final.= '" width="45"></li>
       </div>
                    <div class="col s6">
                <li style="font-size:1.7rem;margin-top: 0.6em;font-family: font-family: GillSans, Calibri, Trebuchet, sans-serif;">&Negat iveMediumSpace; Olá ,   ' . $_SESSION['nome'] . '</li> 
                    </div></div>
                    <div class="col s12 row">
                        <ul>
                            <li><a href="conta.php"><i class="material-icons">person</i>Conta</a></li>
        <li><a href="acaoLogin.php?acao=logoof"><i class="material-icons">exit_to_app</i>Sair</a></li>
                        </ul>
                    </div>
                    
    </ul>
</header>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large roxo pulse">
        <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
        <li><a class="btn-floating roxo tooltipped" data-position="left" data-tooltip="Novo Produto" href="cadastrop.php"><i class="material-icons">publish</i></a></li>
        <li><a class="btn-floating blue tooltipped" data-position="left" data-tooltip="Meus Produtos" href="meusprodutos.php"><i class="material-icons">book</i></a></li>
    </ul>
</div>
';
return $final;
}
