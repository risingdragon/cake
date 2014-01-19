<?php
echo $this->Form->create('Post');
echo $this->Form->input('email', ['class' => 'form-control']);
echo $this->Form->input('title', ['class' => 'form-control']);
echo $this->Form->input('body', ['class' => 'form-control']);
?>
<p>
<?php echo $this->Form->button('登録', ['type' => 'submit', 'class' => 'btn btn-primary btn-small']); ?>
</p>
<?php echo $this->Form->end(); ?>

<p><button id="list" class="btn btn-success btn-small"><i class="glyphicon glyphicon-plus-sign"></i> 一覧へ戻る</button></p>
<script>
$(function(e)
{
	$('#list').on("click", function(e)
	{
		location.href = '<?php echo Router::url(array('action' => '/')) ?>';
	});
});
</script>
