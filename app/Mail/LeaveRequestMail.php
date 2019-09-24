<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\LeaveRequest;

class LeaveRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $leaveRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LeaveRequest $leaveRequest)
    {
        //
//         $this->user = $user;
        $this->leaveRequest = $leaveRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Leave Request Submission!')->view('emails.leave-request');
    }
}
