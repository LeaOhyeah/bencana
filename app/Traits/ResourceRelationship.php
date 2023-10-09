<?php
namespace App\Traits;

use App\Models\{Post, Category};

/**
 * Summary of ResourceRelationship
 * Relationship table posts and categories to aids and reqs 
 */
trait ResourceRelationship
{
     /**
      * Summary of post
      * @return \Illuminate\Database\Eloquent\Relations\Relation 
      */
     public function post()
     {
          return $this->belongsTo(Post::class, 'post_id');
     }

     /**
      * Summary of category
      * @return \Illuminate\Database\Eloquent\Relations\Relation 
      */
     public function category()
     {
          return $this->belongsTo(Category::class, 'category_id');
     }
}