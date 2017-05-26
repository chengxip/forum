<?php
namespace App;

trait Favoritable{
  protected static function bootFavoritable(){
        static::deleting(function($model){
            $model->favorite->each->delete();
        });
  }
}
