<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Console\Command;
use App\Mail\NewPostNotification;
use Illuminate\Support\Facades\Mail;

class SendPostNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:post-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Post Notification to Users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking new Post...');
        $post = Post::where('is_notified', 0)->get();

        if($post->count() >= 1) {
            $this->info('Sending Post Notification...');
            foreach ($post as $post) {
                $subcription_list = Subscription::where('website_id', $post->website_id)->get();

                foreach ($subcription_list as $subcription) {
                    Mail::to($subcription->user->email)->send(new NewPostNotification($post));
                }

                $post->update([
                    'is_notified' => 1,
                ]);
            }
            $this->info('Post Notification Sent!');
        } else {
            $this->info('No new Post to send!');
        }
    }
}
