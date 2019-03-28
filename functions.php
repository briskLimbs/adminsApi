<?php

function pr($a) { echo '<pre>'; print_r($a); echo '</pre>'; }
function pex($a) { pr($a); exit("PEX"); }
function displayMessage($a) { echo "$a\n"; }