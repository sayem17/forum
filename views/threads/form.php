<div class="container">
<div class="cform">
	<h1><?=$type=='edit'?'Edit':'Create New'?></h1>
	<?=view('validation-error')?>

	<form action="/thread/<?=$post?'save':'create'?>" method="post">
		
		<?=csrf_token_field()?>

		<?php if($post): ?>

			<input type="hidden" name="id" value="<?=$post->id?>">

		<?php endif; ?>

		<?php if($type=='add' || is_null($post->parent_id)): ?>
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" class="form-control" name="title" value="<?=form_value('title', $post)?:''?>" placeholder="Enter your thread title" required>
			</div>

			<div class="form-group">

				<label for="topic_id">Topic</label>

				<select name="topic_id" id="topic_id" class="form-control" required="required">

					<?php foreach($topics as $topic): ?>

						<option value="<?=$topic->id?>" <?=form_value('topic_id', $post)==$topic->id?' selected':''?>><?=$topic->name?></option>

					<?php endforeach; ?>

				</select>

			</div>

		<?php endif; ?>

		<div class="form-group">
			<label for="body">Message</label>
			<textarea name="body" id="body" class="richtext" cols="50" rows="10"><?=html_entity_decode(form_value('body', $post))?></textarea>
		</div>
		<p><button type="submit" class="btn btn-block btn-primary">Submit</button></p>
	</form>
</div>
</div>