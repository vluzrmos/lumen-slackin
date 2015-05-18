<?php namespace App\Jobs;

use App\Services\SlackService;
use Illuminate\Contracts\Bus\SelfHandling;

class SlackInvitationJob extends Job implements SelfHandling
{
    protected $email = null;
    protected $username = null;

    public function __construct($email, $username = '')
    {
        $this->email = $email;
        $this->username = $username;
    }

    /**
     * Event Self-Handled handle
     * @param SlackService $slack
     */
    public function handle(SlackService $slack)
    {
        $slack->inviteMember($this->email, $this->username);
    }
}
