<?php echo $this->Html->docType('html5') ?>
<head>
<?php echo $this->Html->meta("viewport", "width=device-width, initial-scale=1.0") ?>
<?php echo $this->Html->css("//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css") ?>
<?php echo $this->Html->css("//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css") ?>
<?php echo $this->Html->script("//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js") ?>
<?php echo $this->Html->script("//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js") ?>
<?php echo $this->Html->script("//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js") ?>
<?php echo $this->Html->script("//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js") ?>
</head>
<body>

<div class="container">

<nav class="navbar navbar-default" role="navigation">
<div class="navbar-header">
<a class="navbar-brand" href="<?php echo Router::url(array('action' => '/')) ?>">CakePostサンプル</a>
</div>
</nav>

<?php echo $this->Session->flash(); ?>
<?php echo $this->fetch("content") ?>
</div>

</body>
</html>
