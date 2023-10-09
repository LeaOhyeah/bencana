<?php
namespace App\Traits;

use App\Models\User;

/**
 * Summary of EditorLog 
 * Relationship table users
 */
trait EditorLog
{
     /**
      * Summary of created_log
      * @return \Illuminate\Database\Eloquent\Relations\Relation 
      */
     public function created_log()
     {
          return $this->belongsTo(User::class, 'created_by');
     }

     /**
      * Summary of edited_log
      * @return \Illuminate\Database\Eloquent\Relations\Relation 
      */
     public function edited_log()
     {
          return $this->belongsTo(User::class, 'edited_by');
     }
}