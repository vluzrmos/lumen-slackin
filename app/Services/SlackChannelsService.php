<?php

namespace App\Services;

use Vluzrmos\SlackApi\Contracts\SlackChannel;

class SlackChannelsService
{
    /**
     * Config index.
     *
     * @var string
     */
    protected $configSpace = 'services.slack';

    /**
     * @var  SlackChannel
     */
    protected $slack;

    /**
     * @param SlackChannel $slack
     */
    public function __construct(SlackChannel $slack)
    {
        $this->slack = $slack;
    }

    /**
     * Get api configurated channels and parse to string to be used in a api request.
     *
     * @return string
     */
    public function getConfigChannelsString()
    {
        $channels = $this->getConfig('channels', '');

        if (in_array($channels, ['all', '*'])) {
            $apiChannels = $this->getApiChannels();
        } else {
            $apiChannels = $this->getApiChannelsById($channels);
        }

        return $this->parseChannelsToString($apiChannels);
    }

    /**
     * Get Configuration for a key with a default (if that doesn't exists).
     *
     * @param      $key
     * @param null $default
     *
     * @return mixed
     */
    protected function getConfig($key, $default = null)
    {
        return config($this->configSpace.'.'.$key, $default);
    }

    /**
     * Get array of channels.
     *
     * @return array
     */
    public function getApiChannels()
    {
        $all = $this->slack->lists();

        $channels = array_filter(
            $all['channels'], function ($channel) {
            return !$channel['is_archived'];
        }
        );

        return $channels;
    }

    /**
     * Get channels by name or ID.
     *
     * @param array $ids
     *
     * @return array
     */
    public function getApiChannelsById($ids = [])
    {
        if (is_string($ids)) {
            $ids = preg_split('/, ?/', $ids);
        }

        $ids = (array)$ids;

        return array_filter(
            $this->getApiChannels(), function ($channel) use (&$ids) {
            return (in_array($channel['id'], $ids) or in_array($channel['name'], $ids));
        }
        );
    }

    /**
     * Parse channels IDs to string to be used in a api request.
     *
     * @param array $channels
     *
     * @return string
     */
    public function parseChannelsToString($channels = [])
    {
        $channels = array_map(
            function ($channel) {
                return $channel['id'];
            }, $channels
        );

        return implode(',', $channels);
    }
}
