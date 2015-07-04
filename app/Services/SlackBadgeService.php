<?php

namespace App\Services;

use Vluzrmos\BadgePoser\Contracts\Poser;

class SlackBadgeService
{
    /**
     * @var SlackStatusService
     */
    protected $slack;
    /**
     * @var Poser
     */
    protected $poser;

    /**
     * @var array
     */
    protected $allowedBadgeFormats = ['flat', 'plastic'];

    /**
     * @param SlackStatusService $slack
     * @param Poser              $poser
     */
    public function __construct(SlackStatusService $slack, Poser $poser)
    {
        $this->slack = $slack;

        $this->poser = $poser;

        app()->configure('slack-badge');
    }

    /**
     * Generate a badge poser
     * @param string $format
     * @return \Illuminate\Http\Response
     */
    public function generate($format = 'flat')
    {
        $totals = $this->slack->getUsersStatus();
        $team = $this->slack->getTeamInfo();

        $subject = $team['name'];
        $status = $totals['active'].'/'.$totals['total'];
        $color = config('slack-badge.color', 'F1504');
        $format = config('slack-badge.format', $format);

        if (!$this->isValidFormat($format)) {
            $format = array_get($this->getAllowedBadgesFormat(), 0, 'flat');
        }

        $response = $this->poser->generate($subject, $status, $color, $format);

        return $response;
    }

    /**
     * Check if the badge format is valid
     * @param $format
     * @return bool
     */
    protected function isValidFormat($format)
    {
        return in_array($format, $this->getAllowedBadgesFormat());
    }

    /**
     * Return the allowed badges format
     * @return array
     */
    protected function getAllowedBadgesFormat()
    {
        return $this->allowedBadgeFormats;
    }
}
