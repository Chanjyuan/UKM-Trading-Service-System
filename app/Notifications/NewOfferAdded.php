<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Offer;
use App\Models\User;
use App\Models\Post;

class NewOfferAdded extends Notification
{
    use Queueable;

    /**
     * The offer post
     * 
     * @var Post
     */

    public $post;
    
    /**
     * The offer
     * 
     * @var Offer
     */

    public $offer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, Offer $offer)
    {
        $this->post = $post;
        $this->offer = $offer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new offer was added to your post.')
                    ->action('View Offer', url('/posts/'.$this->post->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'post' => $this->post,
            'offer' => $this->offer,
            'offerby' => User::find($this->offer->user_id)
        ];
    }
}
