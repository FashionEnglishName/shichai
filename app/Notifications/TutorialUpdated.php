<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Article;
use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TutorialUpdated extends Notification
{
    use Queueable;
    public $tutorial;
    public $author;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Article $tutorial, User $author)
    {
        $this->tutorial = $tutorial;
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

    public function toDatabase(){
        return [
            'tutorial_id' => $this->tutorial->id,
            'tutorial_title' => $this->tutorial->title,
            'author_name' => $this->author->name,
            'author_avatar' => $this->author->avatar,
            'author_id' => $this->author->id
        ];
    }
}
