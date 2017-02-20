<div class="container">

	<div class="lform">
		<p class="center-logo">
			<i class="fa fa-user-circle-o fa-4x"></i>
		</p>

		<h2 class="center-head">Create a New Account</h2>

		<?=view('validation-error');?>

		<form action="/register" method="post">
			<?=csrf_token_field()?>
			<div class="form-group">
				<label for="name">You Name</label>
				<input class="form-control" type="text" name="name" id="name" placeholder="Enter your full name">
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" type="email" name="email" id="email" placeholder="Enter your email">
			</div>

			<div class="form-group">
				<label for="passworld">Password</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="Your secret password">
			</div>

			<div class="form-group">
				<label for="confirm_password">Re-enter</label>
				<input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Enter your password again">
			</div>

			<button type="submit" class="btn btn-block btn-primary"><i class="fa fa-sign-in"></i>Register</button>

		</form>
	</div>

</div>