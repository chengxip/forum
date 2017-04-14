<?php

function create($class,$attr=[],$num = null){
    return factory($class,$num)->create($attr);
}

function make($class,$attr=[],$num = null){
    return factory($class,$num)->make($attr);
}
