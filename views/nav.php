<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Smartphones QA</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="/search">
      <div class="form-group">
        <input type="text" name="q" class="form-control nav-search" placeholder="Search..">
      </div>
      <div class="form-group">
      	<select name="type" id="type" class="form-control" required>
			<option value="title">Thread Title</option>
			<option value="post">Post</option>
			<option value="user">User</option>
		</select>
      </div>
      <button type="submit" class="btn btn-default">Search</button>
    </form>

    <ul class="nav navbar-nav navbar-right">
      	<?php if(is_logged()): ?>
			<li><a href="/thread/new"><i class="fa fa-plus"></i>Create New</a></li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa fa-user-circle-o"></i>Hello, <?=session('user')->name?> <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="/logout">Logout</a></li>
				</ul>
			</li>


		<?php else: ?>
			<li><a href="/login"><i class="fa fa-user-circle-o"></i>Login</a></li>
			<li><a href="/register"><i class="fa fa-sign-in"></i>Register</a></li>
		<?php endif; ?>
    </ul>
  </div>
</nav>