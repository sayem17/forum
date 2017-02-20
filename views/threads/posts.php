<div class="container">
	<div class="row"><div class="col-sm-12">
		<h1><?=$post->title?></h1>

		<h4 class="ls-info"><i class="fa fa-clock-o"></i>Posted <?=time_elapsed_string($post->created_at)?> by <b><?=$post->user->name?></b></h4>

		<p class="excerpt"><?=html_entity_decode($post->body)?></p>

		<?php if(is_logged() && $post->user->id == user()->id): ?>
			<p>
				<a href="/thread/edit?id=<?=$post->id?>">Edit</a> | 
				<a href="/thread/remove?id=<?=$post->id?>">Delete</a>
			</p>
		<?php endif; ?>

		<?php if((int)$post->updated_at > 0): ?>
			<i>Last updated: <?=time_elapsed_string($post->updated_at)?></i>
		<?php endif; ?>

		<hr>
	</div>
</div>


	<ul class="list-group" id="reply<?=$reply->id?>">
	<?php foreach($replies as $reply): ?>
		
		<li class="list-thread">
			
			<figure class="ls-image">
				<img src="/images/generic-avatar.png" alt="" class="ls-avatar">				
			</figure>
			<h4><span class="replier-name"><?=$reply->user->name?></span> <small><i class="fa fa-clock-o"></i><?=time_elapsed_string($reply->created_at)?></small></h4>
			
			<p class="excerpt"><?=html_entity_decode($reply->body)?></p>

			<?php if((int)$reply->updated_at > 0): ?>
				<i>Last updated: <?=time_elapsed_string($reply->updated_at)?></i>
			<?php endif; ?>

			
			<?php if(is_logged() && $reply->user->id == user()->id): ?>
				<span class="ls-action">
					<a href="/thread/edit?id=<?=$reply->id?>"><i class="fa fa-pencil"></i>Edit</a> 
					<a href="/thread/remove?id=<?=$reply->id?>"><i class="fa fa-times"></i>Delete</a>
				</span>
			<?php endif; ?>
			
		</li>

	<?php endforeach; ?>
	</ul>

	<?=view('validation-error')?>

	<?=view('threads.reply-form', compact('post'))?>
</div>