<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Hospital extends Authenticatable implements AuthenticatableContract
{
    use HasFactory;
    public $fillable = [
        'name',
        'email',
        'phone',
        'adress',
        'country',
        'city',
        'province',
        'password',
        'permission'
    ];
    public function timings(){
        return $this->hasMany(test_timing::class);
    }  
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hosp_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($hospital) {
            if ($hospital->permission === 'yes') {
                // Check if timings have been inserted before
                $existingTimings = test_timing::where('hosp_id', $hospital->id)->count();

                if ($existingTimings === 0) {
                    $days = [
                        'Monday',
                        'Tuesday',
                        'Wednesday',
                        'Thursday',
                        'Friday',
                        'Saturday'
                    ];
                    $timings = [
                        '9 to 11',
                        '12 to 2',
                        '3 to 5',
                        '6 to 8',
                    ];

                    foreach ($days as $day) {
                    foreach ($timings as $timing) {
                        test_timing::create([
                            'days' => $day,
                            'hosp_id' => $hospital->id,
                            'timing' => $timing,
                        ]);
                    }}
                }
            } elseif ($hospital->permission === 'no') {
                // Delete existing timings if permission changes to 'no'
                test_timing::where('hosp_id', $hospital->id)->delete();
            }
        });
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($hospital) {
    //         $timings = [
    //             '9 to 11',
    //             '12 to 2',
    //             '3 to 5',
    //             '6 to 8',
    //         ];

    //         foreach ($timings as $timing) {
    //             test_timing::create([
    //                 'user_id' => NULL,
    //                 'hosp_id' => $hospital->id,
    //                 'timing' => $timing,
    //             ]);
    //         }
    //     });
    // }  
}
