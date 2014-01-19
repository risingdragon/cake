<div class="panel panel-primary">
	<div class="panel-heading"><?php echo $this->action == 'add' ? '追加' : '編集' ?></div>
	<div class="panel-body">
		<?php echo $this->Form->create('Post', ['role' => 'form']); ?>

		<div class="form-group">
		<label for="email">メールアドレス</label>
		<?php echo $this->Form->input('email', ['class' => 'form-control', 'id' => 'email', 'label' => false]) ?>
		</div>

		<div class="form-group">
		<label for="title">タイトル</label>
		<?php echo $this->Form->input('title', ['class' => 'form-control', 'id' => 'title', 'label' => false]) ?>
		</div>

		<div class="form-group">
		<label for="body">本文</label>
		<?php echo $this->Form->textarea('body', ['class' => 'form-control', 'id' => 'body', 'label' => false]) ?>
		</div>

		<button type="submit" class="btn btn-primary btn-sm">
		<i class="glyphicon glyphicon-pencil"></i>
		<?php echo $this->action == 'add' ? '追加' : '編集' ?>
		</button>

		<?php echo $this->Form->end(); ?>
	</div>
</div>

<button id="list" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-list"></i> 一覧へ戻る</button>

<script>
$(function(e)
{
	$('#list').on("click", function(e)
	{
		location.href = '<?php echo Router::url(array('action' => '/')) ?>';
	});

	$("form").on("submit", function(e)
	{
		if (confirm("<?php echo $this->action == 'add' ? '追加' : '編集' ?>します。よろしいですか？") == false) {
			e.preventDefault();
		}
	});
});
</script>
