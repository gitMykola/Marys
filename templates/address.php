<div class="btn-block container">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="btn btn-default marys-btn" onclick="$('.add-form-block').slideToggle();">
		<?=$lex['buttons']['addAdr']?></div>
		<div id="adrGet" class="btn btn-default marys-btn">Test</div>
	</div>	
</div>
<div class="add-form-block panel panel-default">
	<form method="POST" action="/address/set" name="adrForm" class="col-sm-6 col-sm-offset-3">
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
	  <button type="submit" class="btn btn-default marys-btn"><?=$lex['buttons']['add']?></button>
	  <div class="form-btn" onclick="$('.add-form-block').fadeOut();"><span class="glyphicon glyphicon-off"></span></div>
	</form>
</div>
<div class="ref-list col-sm-10 col-sm-offset-1">
	<?php
	echo '<div class="table-responsive">
				<table class="table">
					<thead>
					  <tr>
						<th>'.$lex['ref']['addr']['number'].'</th>
						<th>'.$lex['ref']['addr']['country'].'</th>
						<th>'.$lex['ref']['addr']['city'].'</th>
						<th>'.$lex['ref']['addr']['region'].'</th>
						<th>'.$lex['ref']['addr']['street'].'</th>
						<th>'.$lex['ref']['addr']['appart'].'</th>
						<th></th>
					  </tr>	
					</thead>
					<tbody>';
		echo '		
					</tbody>		
				</table>
			</div>';
	?>
</div>
<h2 class=" col-sm-6 col-sm-offset-3">
<?=$lex['title'];?></h2>