<style>
div.error-message {
	margin: 10px 0px 10px 0px;
	padding: 10px;
	background-image: linear-gradient(to bottom, #F2DEDE 0px, #E7C3C3 100%);
	background-repeat: repeat-x;
	border-color: #DCA7A7;
	background-color: #F2DEDE;
	color: #A94442;
}
</style>

<div class="panel panel-primary">
	<div class="panel-heading"><?php echo $this->action == 'add' ? '追加' : '編集' ?></div>
	<div class="panel-body">
		<?php echo $this->Form->create('Post', ['role' => 'form', 'class' => 'form-horizontal']); ?>

		<div class="form-group">
			<label for="send_date" class="col-md-2 control-label">送信時刻</label>
			<div class="form-inline col-md-10">
				<div class="pull-left ">
				<?php echo $this->Form->input('send_date', ['class' => 'form-control', 'id' => 'send_date', 'label' => false, 'style' => 'width:150px']) ?>
				</div>
				<div class="pull-left">(YYYY-MM-DD)　</div>
				<div class="pull-left">
				<?php echo $this->Form->input('send_time', ['class' => 'form-control', 'id' => 'send_time', 'label' => false, 'style' => 'width:100px', 'maxlength' => 4]) ?>
				</div>
				<div class="pull-left">(HHMM)</div>
			</div>
		</div>

		<div class="form-group">
		<label for="email" class="col-md-2 control-label">メールアドレス</label>
		<div class="col-md-8">
		<?php echo $this->Form->input('email', ['class' => 'form-control', 'id' => 'email', 'label' => false]) ?>
		</div>
		</div>

		<div class="form-group">
		<label for="title" class="col-md-2 control-label">タイトル</label>
		<div class="col-md-8">
		<?php echo $this->Form->input('title', ['class' => 'form-control', 'id' => 'title', 'label' => false]) ?>
		</div>
		</div>

		<div class="form-group">
		<label for="body" class="col-md-2 control-label">本文</label>
		<div class="col-md-8">
		<?php echo $this->Form->textarea('body', ['class' => 'form-control', 'id' => 'body', 'label' => false]) ?>
		<?php echo $this->Form->error('Post.body'); ?>
		</div>
		</div>

		<div>
		<button type="submit" class="btn btn-primary btn-sm">
		<i class="glyphicon glyphicon-pencil"></i>
		<?php echo $this->action == 'add' ? '追加' : '編集' ?>
		</button>
		</div>

		<?php echo $this->Form->end(); ?>
	</div>
</div>

<button id="list" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-list"></i> 一覧へ戻る</button>

<script>
$(function(e)
{
	$("#send_date").datepicker();

	$('#list').on("click", function(e)
	{
		location.href = '<?php echo Router::url(array('action' => '/')) ?>';
	});

	$("form").on("submit", function(e)
	{
		e.preventDefault();

		Validator.init(this);
		Validator.require("[required=required]");
		Validator.date("#send_date");
		Validator.number("#send_time");

		var now  = new Date();
		var nowstr =
			now.getFullYear() + Tool.lpad(now.getMonth()+1, "0", 2) + Tool.lpad(now.getDate(), "0", 2) +
			Tool.lpad(now.getHours(), "0", 2) + Tool.lpad(now.getMinutes(), "0", 2);
		if (
			($("#send_date").val().replace(/\-/g, "") + $("#send_time").val())
			< nowstr
		) Validator.showError($("#send_date"), "過去は指定できません");

		if (Validator.isError()) return;

		if (confirm("<?php echo $this->action == 'add' ? '追加' : '編集' ?>します。よろしいですか？")) {
			$(this).off();
			$(this).submit();
		}
	});
});
</script>
