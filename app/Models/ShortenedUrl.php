<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortenedUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_url',
        'short_code',
    ];

    /**
     * Generate a unique short code
     */
    public static function generateShortCode(): string
    {
        do {
            $shortCode = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
        } while (self::where('short_code', $shortCode)->exists());

        return $shortCode;
    }

    /**
     * Get the full short URL
     */
    public function getShortUrlAttribute(): string
    {
        return url('/' . $this->short_code);
    }
}
