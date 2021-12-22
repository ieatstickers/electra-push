<?php

namespace Electra\Push\Api\Provider;

use Electra\Push\Api\PushNotification;

interface PushNotificationProviderInterface
{
  /**
   * @param PushNotification $notification
   *
   * @return bool
   */
  public function send(PushNotification $notification): bool;
}
