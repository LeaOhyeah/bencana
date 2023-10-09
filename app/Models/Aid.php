<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EditorLog;
use App\Traits\TimeFormatting;

class Aid extends Model
{
    use HasFactory, SoftDeletes, EditorLog;
    protected $guarded = ['id'];
}
