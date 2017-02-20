<form action="/thread/reply" method="post" id="form-reply" class="<?=is_logged()?'':'rt-disabled'?>">
	<?=csrf_token_field()?>
	<input type="hidden" name="id" value="<?=$post->id?>">
	<div class="form-group">
		<textarea name="body" id="body" cols="50" rows="10" class="richtext"></textarea>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>