<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Tag extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
    
    public function getByTag(int $limit_count=5)
    {
        return $this->posts()->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
