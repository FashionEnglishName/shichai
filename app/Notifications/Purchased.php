<?php

namespace App\Notifications;

use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Purchased extends Notification
{
    use Queueable;

    public $article;
    public $purchasing_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Article $article, User $user)
    {
        $this->article = $article;
        $this->purchasing_user = $user;
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
            'article_title' => $this->article->title,
            'article_id' => $this->article->id,
            'user_name' => $this->purchasing_user->name,
            'user_id' => $this->purchasing_user->id,
            'user_avatar' => $this->purchasing_user->avatar
        ];
    }
}
