<?php


function collectionToArray($collection)
{
    $array = [];

    foreach($collection as $c)
    {
        $array[] = $c;
    }

    return $array;
}


?>