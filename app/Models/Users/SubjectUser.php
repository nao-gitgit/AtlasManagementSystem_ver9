<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\Users\Subject;

class SubjectUser extends Model
{
    protected $table = 'subject_users';

    protected $fillable = [
        'user_id',
        'subject_id',
    ];

    // Userとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Subjectとのリレーション
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
