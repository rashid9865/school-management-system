<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Teacher;

class TeacherAttendance extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'teacher_id',
        'date',
        'status',
        'time_in',
        'time_out',
        'notes',
        'approval_status',
        'approved_by',
        'remarks',
        'duration_minutes'
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'time_in' => 'datetime:H:i',
        'time_out' => 'datetime:H:i',
    ];

    // Relationships
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Scopes for filtering
    public function scopeByTeacher(Builder $query, $teacherId)
    {
        return $query->where('teacher_id', $teacherId);
    }

    public function scopeByDate(Builder $query, $date)
    {
        return $query->whereDate('date', $date);
    }

    public function scopeByDateRange(Builder $query, $startDate, $endDate)
    {
        return $query->whereDate('date', '>=', $startDate)
                     ->whereDate('date', '<=', $endDate);
    }

    public function scopeByStatus(Builder $query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByApprovalStatus(Builder $query, $approvalStatus)
    {
        return $query->where('approval_status', $approvalStatus);
    }

    public function scopePending(Builder $query)
    {
        return $query->where('approval_status', 'pending');
    }

    public function scopeApproved(Builder $query)
    {
        return $query->where('approval_status', 'approved');
    }

    public function scopeRejected(Builder $query)
    {
        return $query->where('approval_status', 'rejected');
    }

    public function scopePresent(Builder $query)
    {
        return $query->where('status', 'present');
    }

    public function scopeAbsent(Builder $query)
    {
        return $query->where('status', 'absent');
    }

    public function scopeOnLeave(Builder $query)
    {
        return $query->where('status', 'leave');
    }

    // Accessors & Mutators
    public function getIsApprovedAttribute()
    {
        return $this->approval_status === 'approved';
    }

    public function getIsPendingAttribute()
    {
        return $this->approval_status === 'pending';
    }

    public function getIsRejectedAttribute()
    {
        return $this->approval_status === 'rejected';
    }

    public function calculateDuration()
    {
        if ($this->time_in && $this->time_out) {
            $timeIn = \Carbon\Carbon::createFromFormat('H:i', $this->time_in);
            $timeOut = \Carbon\Carbon::createFromFormat('H:i', $this->time_out);
            $this->duration_minutes = $timeOut->diffInMinutes($timeIn);
            $this->save();
        }
    }
}