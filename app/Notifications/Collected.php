<?php

namespace App\Notifications;

use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Collected extends Notification
{
    use Queueable;

    public $user;
    public $article;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Article $article)
    {
        $this->user = $user;
        $this->article = $article;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable){
        return [
            "user_name" => $this->user->name,
            "user_avatar" => $this->user->avatar,
            "user_id" => $this->user->id,
            "article_title" => $this->article->title,
            "article_id" => $this->article->id
        ];
    }
}
