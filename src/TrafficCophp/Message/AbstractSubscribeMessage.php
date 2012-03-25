<?php

namespace TrafficCophp\Message;

use TrafficCophp\Channel\ChannelCollection;
use TrafficCophp\Channel\Channel;

/**
 * Description of AbstractSubscriberMessage
 *
 * @author ole
 */
abstract class AbstractSubscribeMessage extends AbstractMessage {

	abstract public function __construct(ChannelCollection $channels);
	abstract public function addChannel(Channel $channel);


}