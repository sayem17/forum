<div class="container">

	<div class="row">
		<div class="col-sm-2">
			<h2 class="h2-topic">Choose a topic</h2>
			<ul class="list-topic">
				<li class="list-topic-item"><a href="/">All Threads</a></li>
				<?php foreach($topics as $topic): ?>
					
					<li class="list-topic-item"><a href="/threads?topic=<?=$topic->id?>"><?=$topic->name?></a></li>

				<?php endforeach; ?>
			</ul>
		</div>

		<div class="col-sm-10">
			<div class="row">
				<lable class="col-sm-1">Sort by:</lable>

				<div class="col-sm-4">
						<select name="sort" id="sort" class="form-control">
							<?php foreach(App\Thread::sortOptions() as $key=>$val): ?>
								<option value="<?=$key?>"<?=$sort==$key?' selected':''?>><?=$val?></option>
							<?php endforeach; ?>
						</select>
				</div>

			</div>

			<ul class="list-group" id="threads">
			<?php foreach($threads as $thread): ?>
				
				<li class="list-thread">

					<figure class="ls-image">
						<img src="/images/generic-avatar.png" alt="" class="ls-avatar">				
					</figure>

					<h2><a href="/threads?id=<?=$thread->id?>"><?=$thread->title?></a></h2>

					<span class="ls-info">
						<strong><i class="fa fa-tag"></i> <a href="/threads?topic=<?=$thread->topic->id?>"><?=$thread->topic->name?></a></strong> &nbsp;
						<i class="fa fa-clock-o"></i>
						<?=time_elapsed_string($thread->created_at)?> 
						by <b><a href="/user?id=<?=$thread->user->id?>"><?=$thread->user->name?></a></b>

					</span>					

					<p class="excerpt">
						<?=excerpt($thread->body)?>
					</p>

					<aside class="ls-replies"><?=$thread->replies . ' replies'?></aside>
					
					
					<?php if(is_logged() && $thread->user_id == user()->id): ?>
					<span class="ls-action">
						
						<a href="/thread/edit?id=<?=$thread->id?>" class="ls-edit"><i class="fa fa-pencil"></i>Edit</a>
						<a href="/thread/remove?id=<?=$thread->id?>" class="ls-remove"><i class="fa fa-times"></i>Delete</a>
					</span>
					<?php endif; ?>

				</li>

			<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>