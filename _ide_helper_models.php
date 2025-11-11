<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
 */
	class RequestForm extends \Eloquent {}
}

namespace App\Models{
/**
 * @method bool isAdmin()
 * @method bool isHOD()
 * @method bool isHODIT()
 * @method bool isITStaff()
 * @method bool isUser()
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property string|null $department
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestForm> $assignedRequests
 * @property-read int|null $assigned_requests_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestForm> $requests
 * @property-read int|null $requests_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

