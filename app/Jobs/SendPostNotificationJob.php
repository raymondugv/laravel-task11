<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use App\Mail\NewPostNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendPostNotificationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    protected $post;
    protected $email;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post, string $email)
    {
        $this->post = $post;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new NewPostNotification($this->post));
    }
}
