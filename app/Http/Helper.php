<?php

function setStatus($status) {
    return ($status == 1) ? '<div class="text-success">Active</div>' : '<div class="text-danger"> Deactive</div>';
}

function isStatus($status) {
    return ($status == 'on') ? 1 : 0;
}

function entry() {
    return auth()->id();
}

function setobj($inputs, $obj)
{
    foreach($inputs as $key => $input) $obj->{$key} = $input;
    return $obj;
}

function setImage($url = null): string
{
    return ($url != null) ? url($url) : url('img/no_image.jpg');
}