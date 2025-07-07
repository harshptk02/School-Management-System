<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Notification;

class UserObserver
{
    public function created(User $user)
    {
        Notification::create([
            'type' => $user->role,
            'user_id' => $user->id,
            'message' => "New {$user->role} {$user->name} has been registered",
            'expires_at' => now()->addHours(24)
        ]);
    }
}