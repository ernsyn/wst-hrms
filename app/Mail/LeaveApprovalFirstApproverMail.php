<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\LeaveRequestApproval;

class LeaveApprovalFirstApproverMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $leaveRequestApproval;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, LeaveRequestApproval $leave_request_approval)
    {
        //
        $this->user = $user;
        $this->leaveRequestApproval = $leave_request_approval;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Leave Request Approved By First Approver!')->view('emails.leaverequestapprovalbyfirstapprover');
    }
}
