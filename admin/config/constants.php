<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
define("ROOT_URL", "http://localhost/Digital%20Tassie%20Charity/");
define("DB_HOST", "localhost");
define("DB_USER", "sachin");
define("DB_PASS", "admin1234");
define("DB_NAME", "dtc");
