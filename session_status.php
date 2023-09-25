<?php
function checkSessionStatus() {
    $status = session_status();

    if ($status == PHP_SESSION_DISABLED) {
        return "Сессии отключены на сервере PHP.";
    } elseif ($status == PHP_SESSION_NONE) {
        return "Сессии включены, но сессия не создана и не активирована.";
    } elseif ($status == PHP_SESSION_ACTIVE) {
        return "Сессии включены, и сессия создана и активирована.";
    }
}
?>