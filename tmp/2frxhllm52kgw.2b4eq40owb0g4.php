<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Panel de Administración</title>

    <!-- Bootstrap Core CSS -->
    <link href="ui/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="ui/admin/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="ui/admin/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="ui/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- <link rel="stylesheet" href="ui/css/base.css" type="text/css" /> -->
    <!-- <link rel="stylesheet" href="ui/css/theme.css" type="text/css" /> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <?php echo $this->render($content,$this->mime,get_defined_vars(),0); ?>
              <!-- jQuery -->
            <script src="ui/admin/js/jquery.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="ui/admin/js/bootstrap.min.js"></script>

     

    </body>

</html>
