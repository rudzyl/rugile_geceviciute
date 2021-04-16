<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Task extends Model
{
    use HasFactory;

    public static function new() {
        return new self;
    }
    public function refreshAndSave(Request $request) {
       $this->task_name = $request->task_name;
       $this->task_description = $request->task_description;
       $this->status_id = $request->status_id;
       $this->add_date = $request->add_date;
       $this->save();
       return $this;
    }
    public function taskStatus()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }
 
}
