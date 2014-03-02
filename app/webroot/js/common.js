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
});

var Validator = {
	is_error: false,
	form: null,
	require: function(selector)
	{
		this.form.find(selector).each(function(index)
		{
			var target = $(this);
			if (target.attr("data-error") == "on") return;

			if ($.trim(target.val()).length == 0) {
				Validator.showError(target, "必須です");
				return;
			}
		});
	},
	select: function(selector)
	{
		var selected = false;
		var targets = this.form.find(selector);
		var first = $(targets.get(0));
		if (targets.size() == 0) return;
		if (first.attr("data-error") == "on") return;

		if (targets.size() == 1 && targets.val().length > 0) {
			selected = true;
		}

		targets.each(function(index)
		{
			if (this.checked || this.selected) selected = true;
		});

		if (selected == false) {
			Validator.showError(first, "いずれか選択してください", "left");
			return;
		}
	},
	date: function(selector)
	{
		this.form.find(selector).each(function(index)
		{
			var target = $(this);
			if (target.attr("data-error") == "on") return;

			var _val = target.val();
			if (_val && _val.length) {
				if (/[0-9]{4}-[0-1][0-9]-[0-3][0-9]/.test(_val) == false) {
					Validator.showError(target, "日付が正しくありません");
					return;
				}
			}
		});
	},
	number: function(selector)
	{
		this.form.find(selector).each(function(index)
		{
			var target = $(this);
			if (target.attr("data-error") == "on") return;

			var _val = target.val();
			if (_val && _val.length) {
				if (/^[0-9]+$/.test(_val) == false) {
					Validator.showError(target, "数字を入力してください");
					return;
				}
			}
		});
	},
	showError: function(target, msg, msgplace)
	{
		msgplace = msgplace ? msgplace : "right";
		target.attr("data-error", "on");
		target.tooltip({
			animation: false,
			trigger: "manual",
			placement: msgplace,
			title: '<span style="color:#ff0">' + msg + '<span>',
			html: true
		});
		target.tooltip("show");
		target.on("focus", function(e)
		{
			$(this).tooltip("hide");
		});

		this.is_error = true;
	},
	init: function(selector)
	{
		this.form = $(selector);
		this.form.find("input,textarea,select").each(function(index)
		{
			if ($(this).attr("data-error") == "on") {
				$(this).tooltip("destroy");
			}
			$(this).attr("data-error", "off");
		});
		this.is_error = false;
	},
	isError: function()
	{
		if (this.is_error) Validator.showError(this.form.find("[type=submit]"), "エラーがあります");
		return this.is_error;
	}
};

var Tool = {
	lpad: function(str, char, len)
	{
		for (var i=0;i<len;i++) {
			str = (char + "" + str);
		}
		return str.slice(-1 * len);
	}
};
