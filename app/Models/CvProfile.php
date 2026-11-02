<?php

namespace App\Models;

use App\Models\CvPendidikan;
use App\Models\CvPengalaman;
use Illuminate\Database\Eloquent\Model;

class CvProfile extends Model
{
    protected $table = 'cv_profile';
    protected $primaryKey = 'cv_id';
    protected $fillable = [
        'nama',
        'peran',
        'foto',
        'tentang_saya',
        'phone',
        'email',
        'lokasi',
        'website',
    ];

    public function pendidikan()
    {
        return $this->hasMany(CvPendidikan::class, 'cv_id', 'cv_id');
    }

    public function pengalaman()
    {
        return $this->hasMany(CvPengalaman::class, 'cv_id', 'cv_id');
    }
}
