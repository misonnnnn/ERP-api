<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name',
        'created_by',
        'updated_by',
        'is_deleted',
        'extra_info',
    ];

    protected $casts = [
        'extra_info' => 'array',
        'is_deleted' => 'boolean'
    ];

    /**
     * A folder can have many subfolders.
     */
    public function subfolders()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    /**
     * A folder belongs to a parent folder.
     */
    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    /**
     * A folder can contain many documents.
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'folder_id');
    }
}
