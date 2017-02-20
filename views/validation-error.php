<?php if(session('error')): ?>
	<h3 class="error">Please fix the following errors</h3>
	<ul>
	<?php foreach(session('error.validation_errors') as $k=>$v): ?>
		<li class="error"><?=$v?></li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>