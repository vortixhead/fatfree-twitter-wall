<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>Twitter Images Wall</title>
	<base href="<?php echo $SCHEME.'://'.$HOST.':'.$PORT.$BASE.'/'; ?>" />
	<link rel="stylesheet" href="lib/code.css" type="text/css" />
	<link rel="stylesheet" href="ui/css/base.css" type="text/css" />
	<link rel="stylesheet" href="ui/css/theme.css" type="text/css" />
	<script src="ui/js/jquery-2.2.3.min.js"></script>

       <!-- Bootstrap Core JavaScript -->
      <script src="ui/admin/js/bootstrap.min.js"></script>

      <script src="ui/js/masonry.pkgd.min.js"></script>
      <script src="ui/js/imagesloaded.pkgd.min.js"></script>
</head>
<body>
	<?php echo $this->render($content,$this->mime,get_defined_vars(),0); ?>
</body>
</html>