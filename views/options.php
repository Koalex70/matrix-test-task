<?php

$size = count($pageData['options']);
$sizeNewOptions = count($pageData['newOptions']);

echo '<p>' . "Всего $size вариантов:" . '</p>';

foreach ($pageData['options'] as $key => $value) {
    echo '<p>' . ($key + 1) . ') ' . $value . '</p>';
}
if ($sizeNewOptions > 0) {
    echo '<p>' . "Всего $sizeNewOptions новых вариантов:" . '</p>';

    foreach ($pageData['newOptions'] as $key => $value) {
        echo '<p>' . ($key + 1) . ') ' . $value . '</p>';
    }
}
