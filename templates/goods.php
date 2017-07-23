<div>
	<?php
		foreach($data as $d)
		echo '<div>
			<p>Id: '.$d["id"].'</p>
			<p>Name: '.$d["name"].'</p>
			<p>Price: '.$d["price"].'</p>
		</div>';
	?>
</div>
<h2><?=$lex['title'];?></h2>