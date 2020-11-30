<?php

include_once "template.php";
include_once "homepage_template.php";


$themeOff = false;
$darkmode = false;

if (isset($_COOKIE['darkmodeOn'])) {
    $darkmode = true;
}

if (isset($_COOKIE['utsaThemeOff'])) {
    $themeOff = true;
}

if (is_array($_POST) && !empty($_POST)) {
    if (isset($_POST['darkmodeToggle'])) {
        if (isset($_COOKIE['darkmodeOn'])) {
            setcookie('darkmodeOn', false, time() + (10 * 365 * 24 * 60 * 60), '/');
            $darkmode = false;
        } else {
            setcookie('darkmodeOn', true, time() + (10 * 365 * 24 * 60 * 60), '/');
            $darkmode = true;
        }

    }
    if (isset($_POST['utsaThemeToggle'])) {
        if (isset($_COOKIE['utsaThemeOff'])) {
            setcookie('utsaThemeOff', false, time() + (10 * 365 * 24 * 60 * 60), '/');
            $themeOff = false;
        } else {
            setcookie('utsaThemeOff', true, time() + (10 * 365 * 24 * 60 * 60), '/');
            $themeOff = true;
        }
    }
}

html_top("Homepage", array("homepage_courses.css"));
show_homepage($themeOff, $darkmode);
html_bottom();