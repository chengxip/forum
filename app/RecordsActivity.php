<?php
namespace App;

trait RecordsActivity{

    protected static function bootRecordsActivity(){
        if(auth()->guest()) return ;
        foreach(static::getRecordEvent() as $event){
            static::$event( function($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function($model){
            $model->activity()->delete();
        });
    }

    protected static function getRecordEvent(){
        return ['created'];
    }

    protected function recordActivity($event){
        $this->activity()->create([
            'user_id'=> auth()->id(),
            'type'=> $this->getActivityType($event),
        ]);
        /*
        Activity::create([
            'subject_id' => $this->id,
            'subject_type'=> get_class($this)
        ]);
         */
    }

    protected function getActivityType($event){
        return $event.'_'.strtolower((new \ReflectionClass($this))->getShortName());
    }
   
    public function activity(){
        return $this->morphMany(Activity::class,'subject');
    }

}
