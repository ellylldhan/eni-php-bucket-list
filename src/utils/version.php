<?php

function getVer() {
    $module = 4;
    $tp     = 1;
    $branch = "mod4-tp1-route-controleur";
    $descr  = "Route & Contrôleur";

    return [
        "version"     => $module . '.' . $tp,
        "branch"      => $branch,
        "description" => "Module " . $module . " TP " . $tp . " - " . $descr
    ];
}