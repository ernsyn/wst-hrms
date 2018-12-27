<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\LeaveRequestApproval;

class LeaveApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $leaveRequestApproval;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, LeaveRequestApproval $leaveRequestApproval)
    {
        //
        $this->user = $user;
        $this->leaveRequestApproval = $leaveRequestApproval;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Leave Request Approved!')->view('emails.leaverequestapproval');
    }
}
