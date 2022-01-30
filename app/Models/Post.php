<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['title', 'body', 'instrument_id', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    public function getPaginateByLimit(int $limit_count=5)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('instrument')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
