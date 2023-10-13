<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EditedLog;
use App\Traits\EditorLog;
use Illuminate\Support\Carbon;


class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
}
