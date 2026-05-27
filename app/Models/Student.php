<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'user_id',
        'user_account_id',
        'contactno',
        'degree_id',
    ];

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'degree_id')->withDefault();
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course__students', 'student_id', 'course_id');
    }
    public function userAccount()
    {
        return $this->belongsTo(UserAccounts::class, 'user_account_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
