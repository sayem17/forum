<div class="container">

<div class="lform">
	<p class="center-logo">
		<i class="fa fa-user-circle-o fa-4x"></i>
	</p>

	<h2 class="center-head">Login to Your Account</h2>

	
	<?=view('validation-error');?>

	<form action="/login" method="post">
		<?=csrf_token_field()?>
		<div class="form-group">
			<label for="email">Email</label>
			<input class="form-control" type="email" name="email" id="email" placeholder="Enter your email">
		</div>

		<div class="form-group">
			<label for="passworld">Password</label>
			<input class="form-control" type="password" name="password" id="password" placeholder="Your secret password">
		</div>

		<button type="submit" class="btn btn-block btn-primary"><i class="fa fa-sign-in"></i>Login</button>

	</form>

</div>

</div>