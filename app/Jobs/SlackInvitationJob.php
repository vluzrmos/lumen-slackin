<?php

namespace App\Jobs;

use App\Services\SlackTeamService;
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
     * Event Self-Handled handle.
     *
     * @param SlackTeamService $slack
     */
    public function handle(SlackTeamService $slack)
    {
        $slack->inviteMember($this->email, $this->username);
    }
}
