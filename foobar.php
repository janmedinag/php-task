<?php

    $res = "1, 2, ";
    for($i = 3; $i <= 99; $i++) {
        if (fmod($i,3)==0){
            if (fmod($i,5)==0){
                $res = $res.'foobar, ';
            }else{
                $res = $res.'foo, ';
            }
        }else{
            if (fmod($i,5)==0){
                $res = $res.'bar, ';
            }else{
                $res = $res.$i.', ';
            }
        }
    }
    $res = $res.'bar.';

    echo $res;

?>