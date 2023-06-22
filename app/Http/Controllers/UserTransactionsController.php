<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserTransactionsRequest;
use App\Models\User;
use App\Models\UserTransactions;
use App\Services\Exchange;
use App\Services\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user, Request $request)
    {
        $validatedData = $request->validate([
            'sortBy' => [
                'nullable',
                Rule::in(['amount', 'created_at']),
            ],
        ]);

        return $user->transactions()
            ->select('user_id', 'amount', 'comment', 'created_at')
            ->orderBy($validatedData['sortBy'] ?? 'created_at')
            ->paginate();
    }

    /**
     * Return Balance of given User.
     * @param User $user
     * @return float
     */
    public function getBalance(User $user)
    {
        return $user->balance();
    }

    /**
     * Add to User
     * @param User $user
     * @param StoreUserTransactionsRequest $request
     * @return array|string[]
     */
    public function storeAdd(User $user, StoreUserTransactionsRequest $request)
    {
        return Transaction::add($user, $request['amount'], $request['currency']);
    }

    /**
     * Write Off From user.
     * @param User $user
     * @param StoreUserTransactionsRequest $request
     * @return array|string[]
     */
    public function storeSubtract(User $user, StoreUserTransactionsRequest $request)
    {
        return Transaction::subtract($user, $request['amount'], $request['currency']);
    }

    /**
     * Transfer from user to user.
     * @param User $sender_user
     * @param User $receiver_user
     * @param StoreUserTransactionsRequest $request
     * @return string[]
     */
    public function storeTransfer(User $sender_user, User $receiver_user, StoreUserTransactionsRequest $request)
    {
        return Transaction::transfer($sender_user, $receiver_user, $request['amount'], $request['currency']);
    }
}
