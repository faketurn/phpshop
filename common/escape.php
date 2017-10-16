<?php
function escape($posted_data) {
    foreach ($posted_data as $key => $value) {
        $escaped[$key] = htmlspecialchars($value, ENT_QUOTES, "utf-8");
    }
    return $escaped;
}
