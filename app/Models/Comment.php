<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'admin_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
