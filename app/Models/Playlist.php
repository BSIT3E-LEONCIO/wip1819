<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Playlist extends Model
{
    protected $fillable = [
        'user_id', 'link', 'embed_url'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
