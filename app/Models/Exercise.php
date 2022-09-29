<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exercise extends Model
{
    use HasFactory;

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participations() {
        return $this->hasMany(Participate::class);
    }

    public function isStudentRegistered($id) {
        $giveExercises = $this->giveexercises;
        foreach($giveExercises as $entry) {
            if ($entry->user_id == $id) {
                return true;
            }
        }
        return false;
    }

    public function giveexercises() {
        return $this->hasMany(Giveexercises::class);
    }

    protected static function booted()
    {
        static::creating(function ($exercise) {
            $exercise->user_id = Auth::id();
        });
    }
}
