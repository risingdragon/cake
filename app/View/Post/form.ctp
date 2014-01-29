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
		<label for="send_date" class="col-md-2 control-label">送信日(YYYY-MM-DD)</label>
		<div class="col-md-2">
		<?php echo $this->Form->input('send_date', ['class' => 'form-control', 'id' => 'send_date', 'label' => false]) ?>
		</div>
		</div>

		<div class="form-group">
		<label for="send_time" class="col-md-2 control-label">送信時刻(HHMM)</label>
		<div class="col-md-2">
		<?php echo $this->Form->input('send_time', ['class' => 'form-control', 'id' => 'send_time', 'label' => false]) ?>
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
	$.datepicker.regional["ja"] = {
		clearText: "クリア", clearStatus: "日付をクリアします",
		closeText: "閉じる", closeStatus: "変更せずに閉じます",
		prevText: "&#x3c;前", prevStatus: "前月を表示します",
		prevBigText: "&#x3c;&#x3c;", prevBigStatus: "前年を表示します",
		nextText: "次&#x3e;", nextStatus: "翌月を表示します",
		nextBigText: "&#x3e;&#x3e;", nextBigStatus: "翌年を表示します",
		currentText: "今日", currentStatus: "今月を表示します",
		monthNames: [
			"1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"
		],
		monthNamesShort: [
			"1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"
		],
		monthStatus: "表示する月を変更します", yearStatus: "表示する年を変更します",
		weekHeader: "週", weekStatus: "暦週で第何週目かを表します",
		dayNames: ["日曜日","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日"],
		dayNamesShort: ["日","月","火","水","木","金","土"],
		dayNamesMin: ["日","月","火","水","木","金","土"],
		dayStatus: "週の始まりをDDにします", dateStatus: "Md日(D)",
		dateFormat: "yy-mm-dd", firstDay: 0,
		initStatus: "日付を選択します", isRTL: false,
		showMonthAfterYear: true};
	$.datepicker.setDefaults($.datepicker.regional["ja"]);

	$("#send_date").datepicker();

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
