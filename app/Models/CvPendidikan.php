<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvPendidikan extends Model
{
    protected $table = 'cv_pendidikan';

    protected $primaryKey = 'pendidikan_id';

    public $timestamps = false;

    protected $fillable = [
        'cv_id',
        'gelar',
        'institusi',
        'tahun',
        'ipk'
    ];

    public function profile()
    {
        return $this->belongsTo(CvProfile::class, 'cv_id', 'cv_id');
    }
}
