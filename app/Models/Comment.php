<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function commentable()
    {

        // This defines the polymorphic relationship. 
        // The morphTo method indicates that the Comment model can belong to multiple different types of models.
        //  This method does not specify which model it relates to;
        //  that’s determined by the commentable_type and commentable_id columns in the database.
        return $this->morphTo();
    }
    public function user()
    {

        // This defines the inverse of the relationship. 
        // Each Comment belongs to one User. The belongsTo method sets 
        // up the inverse of the one-to-many relationship.
        return $this->belongsTo(User::class);
    }
}

