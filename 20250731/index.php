<?php
$array = array(array("id" => "af78ef16-95b1-4c18-8002-d6a07dcef4a1", "name" => "John", "age" => 20), array("id" => "af78ef16-95b1-4c18-8002-d6a07dcef4a2", "name" => "Jane", "age" => 21), array("id" => "af78ef16-95b1-4c18-8002-d6a07dcef4a3", "name" => "Jim", "age" => 22), array("id" => "af78ef16-95b1-4c18-8002-d6a07dcef4a4", "name" => "Jill", "age" => 23));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1><?= "Hello" . " " . "World"; ?></h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
        <?php foreach ($array as $person) { ?>
            <tr>
                <td><?= $person["id"] ?></td>
                <td><?= $person["name"] ?></td>
                <td><?= $person["age"] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>