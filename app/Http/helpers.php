<?php
function message($string)
{
    $json = json_decode(file_get_contents(public_path() . '/message.json'));
    return $json->$string;
}
