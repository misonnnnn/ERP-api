<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder_id',
        'name',
        'type',
        'size',
        'current_version_id',
        'created_by',
        'is_deleted',
        'extra_info',
    ];

    protected $casts = [
        'extra_info' => 'array',
        'is_deleted' => 'boolean',
    ];

    /**
     * A document belongs to a folder.
     */
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

}
