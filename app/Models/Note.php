<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable = ['title', 'description', 'img', 'group_users_id'];

    public function scopeCreationDate($query, $firstDate, $lastDate)
    {
        if ($firstDate || $lastDate) {
            return $query->where('created_at', '>=', $firstDate.' 00:00:00')
                         ->where('created_at', '<=', $lastDate.' 23:59:59');
        }
    }

    public function scopeImgExist($query, $imgExist)
    {
        if ($imgExist == 'exist') {
            return $query->where('img', '<>', '');
        }
    }
}
