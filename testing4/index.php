<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'lib/simplehtmldom/simple_html_dom.php';


if (!empty($_POST['team'])) {

    $team = trim($_POST['team']);

    $obj = new testing4\app\Crawler();

    $app = new testing4\app\ParserApp($obj);
    $app->execute($team);
}

?>

<form method="post" action="index.php" style="margin: 10px">
    <input type="text" name="team" placeholder="Команда">
    <input type="submit" name="submit" value="Найти">
</form>



