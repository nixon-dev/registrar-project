<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'document_request';

    protected $primaryKey = 'dr_id';

    protected $fillable = [
        'admin_id',
        'student_id',
        'last_name',
        'first_name',
        'middle_name',
        'course',
        'year_graduated',
        'or_number',
        'or_date',
        'request_type',
        'purpose',
        'status',
        'request_date'
    ];
}