<?php

$name = filter_input(INPUT_POST, 'name');
if (filter_has_var(INPUT_POST, 'login')) {
    echo "$name clicked the button <b>Log in</b>";
} else if (filter_has_var(INPUT_POST, 'signup')) {
    echo "$name clicked the button <b>Sign up</b>";
}

?>