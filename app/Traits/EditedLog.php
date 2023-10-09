<?php
namespace App\Traits;

use Illuminate\Support\Carbon;


/**
 * Summary of EditedLog 
 * formated atributes created_at, updated_at and deleted_at
 */
trait EditedLog
{
     /**
      * Summary of created_at_formated
      * @return string created_at atribute
      */
     public function created_at_formated()
     {
          if ($this->created_at == null) {
               return "";
          }
          return Carbon::parse($this->attributes['created_at'])->translatedFormat('d F Y, H:i:s');
     }

     /**
      * Summary of updated_at_formated
      * @return string updated_at atribute
      */
     public function updated_at_formated()
     {
          if ($this->updated_at == null) {
               return "";
          }
          return Carbon::parse($this->attributes['updated_at'])->translatedFormat('d F Y, H:i:s');
     }
     
     /**
      * Summary of deleted_at_formated
      * @return string deleted_at atribute
      */
     public function deleted_at_formated()
     {
          if ($this->deleted_at == null) {
               return "";
          }
          return Carbon::parse($this->attributes['deleted_at'])->translatedFormat('d F Y, H:i:s');
     }
}