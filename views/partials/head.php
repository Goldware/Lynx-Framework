<html>
<head>
    <meta charset="<?php echo $encode; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link href="core/css/bootstrap.min.css" rel="stylesheet">
    <link href="core/css/footer.css" rel="stylesheet">
    <?php if($useOwnCss) {echo '<link href="core/css/' . $ownCssDir . '" rel="stylesheet">';} ?>
</head>
<body>