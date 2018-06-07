<?php

namespace App\Notifications;

use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Missed extends Notification
{
    use Queueable;

    public $article;
    public $author;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Article $article, User $author)
    {
        $this->article = $article;
        $this->author = $author;
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

    public function toDatabase($notifiable)
    {
        return [
            'article_title' => $this->article->title,
            'article_id' => $this->article->id,
            'author_name' => $this->author->name,
            'author_avatar' => $this->author->avatar,
            'author_id' => $this->author->id
        ];
    }
}
