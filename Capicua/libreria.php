<?php

    function esCapicua($paths){
        $capi = false;
        if($paths == strrev($paths)){
            $capi = true;
        }
        return $capi;
    }
?>