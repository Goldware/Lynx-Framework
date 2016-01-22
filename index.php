<?php

include('core/init.php');

include('views/partials/head.php');
include('views/partials/navbar.php');
echo '<div class="container">';

// Include views
if(isset($_GET['page']) && $_GET['page'] == 0)
{
    // include('views/..');
}
elseif(isset($_GET['page']) && $_GET['page'] == 1)
{
    // include('views/..');
}
else
{
    include('views/index.php');
}

echo '</div>';

// Include javascript libs
echo '<script src="core/js/lib/jquery.min.js"></script>';
echo '<script src="core/js/lib/bootstrap.min.js"></script>';
echo '<script src="core/js/app.js"></script>';

if($useFooter) { include('views/partials/footer.php'); }

?>