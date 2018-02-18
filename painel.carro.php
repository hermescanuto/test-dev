<div class="form-horizontal painelcarro">
<fieldset>

<!-- Form Name -->
<legend>Carro:</legend>

<input id="id" name="id" type="hidden" value="">



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="marca">Marca:</label>
  <div class="col-md-4">  
  <select id="marca" name="marca"  class="form-control input-md" >
    <option value="-1" selected >Escolha</option>
    <option value="Volvo">Volvo</option>
    <option value="Saab">Saab</option>
    <option value="Mercedes">Mercedes</option>
    <option value="Audi">Audi</option>
  </select>
 
    
  </div>

   <span class='erro' id='marcaI'>* Campo Obrigatório</span>
  
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="modelo">Modelo:</label>  
  <div class="col-md-4">
  <input id="modelo" name="modelo" type="text"  class="form-control input-md">
    
  </div>
   <span class='erro' id='modeloI'>* Campo Obrigatório</span>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="ano">Ano:</label>  
  <div class="col-md-4">
  <input id="ano" name="ano" type="text"  class="form-control input-md">
    
  </div>
   <span class='erro' id='anoI'>* Campo Obrigatório Numérico </span>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="send"></label>
  <div class="col-md-4">
    <button id="send" name="send" class="btn btn-primary">+</button>
  </div>
</div>

</fieldset>
</div>