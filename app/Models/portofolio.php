<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'contribution',
        'description',
        'place',
        'certificate',
        'student_id'
    ];
    protected $table = "portofolio";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'student_id';
}