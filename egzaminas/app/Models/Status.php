<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Status extends Model
{
    use HasFactory;
    public static function new() {    
        return new self;
    }

    public function refreshAndSave(Request $request) {
        $this->name = $request->status_name;
        $this->save();
        return $this;
       }
    
    public function statusTask()
   {
       return $this->hasMany('App\Models\Task', 'status_id', 'id');
   }

}
