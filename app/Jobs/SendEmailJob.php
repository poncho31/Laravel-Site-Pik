<?php

namespace App\Jobs;

use App\Mail\contact;
use Illuminate\Bus\Queueable;
use App\contact as ContactEntity;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ContactEntity $contentMail)
    {
        $this->contentMail = $contentMail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new contact($this->contentMail);
        Mail::to(env('MAIL_USERNAME', 'pikpinchart@gmail.com'))
            ->send($email);
    }
}
