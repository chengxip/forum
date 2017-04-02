<?php
namespace App\Filter;

use Illuminate\Http\Request;

abstract class Filter{
    protected $query;
    protected $filters = [];
    protected $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    // Apply the query build with filter
    public function apply($query){
        $this->query = $query;

        foreach($this->getFilters() as $filter => $value){
            if(method_exists($this,$filter)){
                $this->$filter($value);
            }
        }
        return $this->query;
    }

    //get all request filter from the valid filter defined in subclass
    protected function getFilters(){
        return $this->request->intersect($this->filters);
    }
}
