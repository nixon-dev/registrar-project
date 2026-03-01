<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
class Document extends Model
{
    use HasFactory, SoftDeletes;

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
        'request_type',
        'status',
        'request_date'
    ];
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    
    public function getFullnameAttribute()
{
    $last = Str::title(strtolower($this->last_name));
    $first = Str::title(strtolower($this->first_name));
    $middle = $this->middle_name ? Str::title(strtolower($this->middle_name)) : '';

    return trim($last . ', ' . $first . ($middle ? ' ' . $middle : ''));
}

    public function getShortFullnameAttribute()
    {
        return Str::limit($this->fullname, 30, '...');
    }

    public function getRequestIconAttribute()
    {
        return match ($this->request_type) {
            'Transcript of Records' => 'bi-file-earmark-text',
            'Certificate of Graduation' => 'bi-mortarboard',
            'Diploma' => 'bi-award',
            'Honorable Dismissal' => 'bi-files',
            default => 'bi-file-earmark',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'Ready for Pickup' => 'ready',
            'Processing' => 'processing',
            'Released' => 'released',
            default => 'pending',
        };
    }

    public function getStatusIconAttribute() {
        return match ($this->status) {
            'Ready for Pickup' => 'bi-box-seam',
            'Processing' => 'bi-pen',
            'Released' => 'bi-check-circle',
            default => 'bi-exclamation-circle',
        };
    }
    

    protected $casts = [
        'request_date' => 'date',
    ];


    protected $appends = ['fullname'];


}
