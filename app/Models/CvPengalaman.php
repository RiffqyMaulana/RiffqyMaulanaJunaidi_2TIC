<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvPengalaman extends Model
{

    protected $table = 'cv_pengalaman';

    protected $primaryKey = 'pengalaman_id';

    public $timestamps = false;

    protected $fillable = [
        'cv_id',
        'posisi',
        'perusahaan',
        'periode',
        'deskripsi'
    ];

    public function profile()
    {
        return $this->belongsTo(CvProfile::class, 'cv_id', 'cv_id');
    }
}
