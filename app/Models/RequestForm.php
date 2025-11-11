<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $reference_number
 * @property string $form_code
 * @property string $form_title
 * @property int|null $user_id
 * @property string $name
 * @property string $department
 * @property string|null $email
 * @property string|null $phone
 * @property array<array-key, mixed>|null $request_data
 * @property string $status
 * @property int|null $hod_verified_by
 * @property \Illuminate\Support\Carbon|null $hod_verified_at
 * @property int|null $approved_by
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property int|null $rejected_by
 * @property \Illuminate\Support\Carbon|null $rejected_at
 * @property string|null $rejection_reason
 * @property int|null $assigned_to
 * @property \Illuminate\Support\Carbon|null $assigned_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property string|null $completion_notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $approver
 * @property-read \App\Models\User|null $assignedUser
 * @property-read \App\Models\User|null $hodVerifier
 * @property-read \App\Models\User|null $rejecter
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereAssignedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereCompletionNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereFormCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereFormTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereHodVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereHodVerifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereReferenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereRejectedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereRejectedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereRequestData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestForm whereUserId($value)
 * @mixin \Eloquent
 */
class RequestForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'form_code',
        'form_title',
        'user_id',
        'name',
        'department',
        'email',
        'phone',
        'nric',
        'request_data',
        'status',
        'hod_verified_by',
        'hod_verified_at',
        'approved_by',
        'approved_at',
        'rejected_by',
        'rejected_at',
        'rejection_reason',
        'assigned_to',
        'assigned_at',
        'completed_at',
        'completion_notes',
    ];

    protected $casts = [
        'request_data' => 'array',
        'hod_verified_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'assigned_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Relationship: User who submitted the request
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship: HOD who verified
     */
    public function hodVerifier()
    {
        return $this->belongsTo(User::class, 'hod_verified_by');
    }

    /**
     * Relationship: HOD IT who approved
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Relationship: User who rejected
     */
    public function rejecter()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * Relationship: IT Staff assigned to
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
