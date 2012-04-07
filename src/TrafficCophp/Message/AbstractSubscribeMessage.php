<?php

namespace TrafficCophp\Message;

use TrafficCophp\Channel\ChannelCollection;
use TrafficCophp\Channel\Channel;

/**
 * Description of AbstractSubscriberMessage
 *
 * @author ole
 */
abstract class AbstractSubscribeMessage extends AbstractSendMessage {

	abstract public function __construct(ChannelCollection $channels);

}