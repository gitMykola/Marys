<div class="btn-block container">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="btn btn-default marys-btn"><?=$lex['buttons']['add']?></div>
        <div class="btn btn-default marys-btn"><?=$lex['buttons']['edit']?></div>
        <div class="btn btn-default marys-btn"><?=$lex['buttons']['delete']?></div>
		<div id="adrGet" class="btn btn-default marys-btn">Test</div>
	</div>	
</div>
<div class="address-form-block panel panel-default modal">
    <form method="POST" action="" name="adrForm" class="col-sm-6 col-sm-offset-3">
      <p name="id"></p>
	  <div class="form-group">
		<label for="country"><?=$lex['ref']['addr']['country']?>:</label>
		<input type="text" class="form-control" id="country" name="country">
	  </div>
	  <div class="form-group">
		<label for="city"><?=$lex['ref']['addr']['city']?>:</label>
		<input type="text" class="form-control" id="city" name="city">
	  </div>
	  <div class="form-group">
		<label for="region"><?=$lex['ref']['addr']['region']?>:</label>
		<input type="text" class="form-control" id="region" name="region">
	  </div>
	  <div class="form-group">
		<label for="street"><?=$lex['ref']['addr']['street']?>:</label>
		<input type="text" class="form-control" id="street" name="street">
	  </div>
	  <div class="form-group">
		<label for="appartment"><?=$lex['ref']['addr']['appart']?>:</label>
		<input type="text" class="form-control" id="appartment" name="appartment">
	  </div>
	  <button type="submit" class="btn btn-default marys-btn" name="apply"><?=$lex['buttons']['apply']?></button>
	  <div class="form-btn" onclick="$('.address-form-block').fadeOut();"><span class="glyphicon glyphicon-off"></span></div>
	</form>
</div>
<div class="address-container"></div>
<div class="modalYesNo text-center">
    <div>
        <h2><?=$lex['message']['more'];?>?</h2>
        <p>
            <p class="btn btn-default marys-btn"><?=$lex['buttons']['no'];?></p>
            <p class="btn btn-default marys-btn"><?=$lex['buttons']['yes'];?></p>
        </p>
    </div>
</div>