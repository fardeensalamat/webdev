<?php

namespace App\Notifications;

use Str;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Commented extends Notification
{
    use Queueable;

    public $comment;
    public $item;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
        $this->item = $comment->commentable;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
    
    public function toDatabase($notifiable)
    {
        if($this->comment->isOfPost())
        {
            $this->item->postable->touchMainsIncrement();
        }

        // dd($this->item);
        return [

            'comment_id' => $this->comment->id,
            'commentable_id' => $this->comment->commentable_id,
            'commentable_type'=>$this->comment->commentable_type,
            'commentable_title' => Str::limit($this->comment->commentable->description, 25, '..'),
            'comment_by_id' => $this->comment->addedby_id,
            'comments_count_of_item' => $this->item->comments()->count(),

            
        ];
    }
}
