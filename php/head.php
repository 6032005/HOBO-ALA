<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $head["title"] ?></title>
    <meta name="description" content="<?php echo $head["description"] ?>">
    <?php foreach ($head["stylesheets"] as $stylesheet) { ?>
        <link rel="stylesheet" href="<?php echo $stylesheet ?>">
    <?php } ?>
    <?php foreach ($head["scripts"] as $script) { ?>
        <script src="<?php echo $script ?>"></script>
    <?php } ?>
</head>