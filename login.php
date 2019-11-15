<style>
    a.btn{
  margin-top: 30%;
  }
.modal {
 max-height:100%;
 overflow:hidden;
}

input[type="submit"]{
  width: 100%;
  margin-top: 50px;
}
</style>
<div class="modal section" id="login">

  <div class="container">
    <div class="row">
     <div class="col s12">
        <br/>
        <h3 class="center">Entrar</h3>
      </div> 
       <form action="acaoLogin.php" method="post" id="">
      <div class="col s12 l6">
        <div class="input-field">
            <input name="log" id="log" type="text" data-mask="000.000.000-00">
            <label for="log">CPF</label>
        </div>
      </div>
        <div class="col s12 l6">
        <div class="input-field">
            <input id="senha2" name="senha" type="password">
             <label for="senha">Senha</label>
           </div>
         </div> <br class="hide-on-med-and-down ">
          <br class="hide-on-med-and-down ">

        <div class="col s12 center">
              <button class="btn waves-effect waves-light roxo"  type="submit" name="acao"  onclick='insertData()'value="login">Enviar</button>
        </div>
        </form>
        <div class="left">
          <a href="recuperaemail.php">Esqueceu a senha?</a>
        </div>
    </div>
  </div>
</div>
