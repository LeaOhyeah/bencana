<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EditedLog;;
use App\Traits\EditorLog;
use Illuminate\Support\Carbon;

class Disaster extends Model
{
    use HasFactory, SoftDeletes, EditorLog, EditedLog;
    protected $guarded = ['id'];

    public function start_date()
    {
        if ($this->start_date == null) {
            return "";
        }
        return Carbon::parse($this->attributes['start_date'])->translatedFormat('d F Y');
    }
    
    public function end_date()
    {
        if ($this->end_date == null) {
            return "";
        }
        return Carbon::parse($this->attributes['end_date'])->translatedFormat('d F Y');
    }
    
    public function closed_date()
    {
        if ($this->closed_date == null) {
            return "";
        }
        return Carbon::parse($this->attributes['closed_date'])->translatedFormat('d F Y');
    }
}
