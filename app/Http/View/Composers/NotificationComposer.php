<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

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

            // 1. Fetch Eloquent collections
            $announcements = $user->unreadAnnouncements()->get();
            $krsNotifications = $user->unreadKrsNotifications()->get();

            // 2. Manually build a plain PHP array with a standard structure
            $combinedNotifications = [];

            foreach ($announcements as $item) {
                $combinedNotifications[] = [
                    'id' => $item->id,
                    'message' => $item->judul,
                    'link' => route('pengumuman.show', $item->id),
                    'created_at' => $item->created_at,
                    'type' => 'announcement'
                ];
            }

            foreach ($krsNotifications as $item) {
                $combinedNotifications[] = [
                    'id' => $item->id,
                    'message' => $item->message,
                    'link' => $item->link ?? '#',
                    'created_at' => $item->created_at,
                    'type' => 'krs'
                ];
            }

            // 3. Create a new Laravel Collection from the plain array, then sort and slice
            $allNotifications = collect($combinedNotifications)->sortByDesc('created_at');

            $unreadNotificationsCount = $allNotifications->count();
            $latestNotifications = $allNotifications->take(5);

            // 4. Pass to the view
            $view->with('unreadNotificationsCount', $unreadNotificationsCount);
            $view->with('latestNotifications', $latestNotifications);

        } else {
            $view->with('unreadNotificationsCount', 0);
            $view->with('latestNotifications', collect());
        }
    }
}