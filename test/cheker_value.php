<?php

session_start();
$session_state=isset($_SESSION['test'])?$_SESSION['test']:null;
if (isset($session_state)) {
    echo 'ok';
} else {
    echo 'else';
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

