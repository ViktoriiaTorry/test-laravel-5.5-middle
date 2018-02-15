<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'text', 'parent_id'];

    /**
     * get user
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    /**
     * get post
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    /**
     * get parrent record
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function parent(){
        return $this->hasOne('App\Models\Comment', 'id', 'parent_id');
    }

    /**
     * get children records
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function children(){
        return $this->hasMany('App\Models\Comment', 'parent_id', 'id');
    }

}
