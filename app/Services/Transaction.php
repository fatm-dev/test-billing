<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Transaction
{
    /**
     * @param User $user
     * @param float $amount
     * @param mixed $currency
     * @return array
     */
    public static function add(User $user, float $amount, mixed $currency): array
    {
        if ($currency && $currency !== 'KZT') {
            $transferAmount = Exchange::convert($currency, $amount);
        }

        try {
            DB::beginTransaction();
            $user->transactions()->create([
                'amount' => $transferAmount ?? $amount,
                'original_amount' => $currency . $amount,
                'comment' => 'Добавлено'
            ]);

            DB::commit();
            return ['status' => true, 'message' => 'Деньги начислены'];
        } catch (Exception $e) {
            Log::error('Error on update container' . $e->getMessage());
            abort(500, 'При начислении произошла ошибка');
        }
    }

    /**
     * @param User $user
     * @param float $amount
     * @param mixed $currency
     * @return array
     */
    public static function subtract(User $user, float $amount, mixed $currency): array
    {
        if ($currency && $currency !== 'KZT') {
            $transferAmount = Exchange::convert($currency, $amount);
        }

        $finalAmount = $transferAmount ?? $amount;

        if ($user->balance() < $finalAmount) {
            abort(403, 'Недостаточно средств');
        }

        try {
            DB::beginTransaction();
            $user->transactions()->create([
                'amount' => -($transferAmount ?? $amount),
                'original_amount' => $currency . $amount,
                'comment' => 'Списано'
            ]);

            DB::commit();
            return ['status' => true, 'message' => ''];
        } catch (Exception $e) {
            Log::error('Error on update container' . $e->getMessage());
            abort(500, 'При списании произошла ошибка');
        }
    }

    /**
     * @param User $sender_user
     * @param User $receiver_user
     * @param mixed $amount
     * @param mixed $currency
     * @return array
     */
    public static function transfer(User $sender_user, User $receiver_user, float $amount, mixed $currency): array
    {
        if ($currency && $currency !== 'KZT') {
            $transferAmount = Exchange::convert($currency, $amount);
        }

        $finalAmount = $transferAmount ?? $amount;

        if ($sender_user->balance() < $finalAmount) {
            abort(403, 'Недостаточно средств');
        }

        try {
            DB::beginTransaction();
            $sender_user->transactions()->create([
                'amount' => -$finalAmount,
                'original_amount' => $currency . $amount,
                'comment' => 'Переведено пользователю ' . $receiver_user->name
            ]);

            $receiver_user->transactions()->create([
                'amount' => $finalAmount,
                'original_amount' => $currency . $amount,
                'comment' => 'Переведено c пользователя ' . $sender_user->name
            ]);

            DB::commit();
            return ['status' => true, 'message' => ''];
        } catch (Exception $e) {
            Log::error('Error on update container' . $e->getMessage());
            abort(500, 'При перевода произошла ошибка');
        }
    }

}
