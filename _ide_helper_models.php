<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserTransactions> $transactions
 * @property-read int|null $transactions_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserTransactions
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $receiver_user_id
 * @property int $amount
 * @property string $original_amount
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserTransactionsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions whereOriginalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions whereReceiverUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTransactions whereUserId($value)
 */
	class UserTransactions extends \Eloquent {}
}

