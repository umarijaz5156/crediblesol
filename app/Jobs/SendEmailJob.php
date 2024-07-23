<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mail_to, $data, $ccRecipients = [];
    /**
     * Create a new job instance.
     */
    public function __construct($data, $to, $ccRecipients = [])
    {
        $this->data = $data;
        $this->mail_to = $to;
        $this->ccRecipients = $ccRecipients;
    }

    public function handle(): void
    {
        $email = new SendMail($this->data);

        if(count($this->ccRecipients) > 0) {
            $email->cc($this->ccRecipients);
        }

        Mail::to($this->mail_to)->send($email);
    }
}
