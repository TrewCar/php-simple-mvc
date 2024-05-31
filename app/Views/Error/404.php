<?php
$title = '404 not found';
$layout = 'Layouts/main';
?>
<link rel="stylesheet" href="<?=auto_version("/assets/css/error.css")?>">
<h1>404 Not Found</h1>
<p>Oops! The page you are looking for does not exist.</p>
<p>It might have been moved or deleted.</p>
<p>Return to the <a href="/">homepage</a> or use the navigation to find what you're looking for.</p>
<?php if(\Core\Data\Constant::IsDebug()) {?>
    <p class="error">ERROR: <?= \Core\Data\Constant::GetError()?></p>
<?php } ?>
