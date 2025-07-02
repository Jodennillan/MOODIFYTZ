<?php

namespace App\Notifications;

use App\Models\MoodEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WeeklyMoodSummary extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $moods = MoodEntry::where('user_id', $notifiable->id)
                     ->where('created_at', '>=', now()->subWeek())
                     ->pluck('mood');

        $total = $moods->count();
        $topMood = $moods->countBy()->sortDesc()->keys()->first();

        return (new MailMessage)
            ->greeting("Weekly Mood Summary 💡")
            ->line("You've logged your mood $total times this week.")
            ->line("Most frequent mood: **$topMood**.")
            ->action('View Mood History', url('/mood'))
            ->line("Keep tracking. You're doing great.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
