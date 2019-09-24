<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\LeaveRequest;

class LeaveRejectedFirstApproverMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $leaveRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LeaveRequest $leave_request_rejected)
    {
        //
        $this->leaveRequest = $leave_request_rejected;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Leave Request Rejected!')->view('emails.leave-request-rejected-by-first-approver');
    }
}
