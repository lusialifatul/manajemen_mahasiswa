<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $unreadNotificationsCount = $user->notifikasiBelumDibaca()->count();
            $latestUnreadNotifications = $user->notifikasiBelumDibaca()->latest()->take(5)->get(); // Ambil 5 notifikasi terbaru

            $view->with('unreadNotificationsCount', $unreadNotificationsCount);
            $view->with('latestUnreadNotifications', $latestUnreadNotifications);
        } else {
            $view->with('unreadNotificationsCount', 0);
            $view->with('latestUnreadNotifications', collect());
        }
    }
}