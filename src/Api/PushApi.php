<?php

namespace Electra\Push\Api;

use Electra\Push\Api\Provider\PushNotificationProviderInterface;

class PushApi
{
  /** @var PushNotificationProviderInterface */
  private $provider;

  private function __construct(PushNotificationProviderInterface $provider)
  {
    $this->provider = $provider;
  }

  /**
   * @param PushNotificationProviderInterface $provider
   *
   * @return PushApi
   */
  public static function init(PushNotificationProviderInterface $provider): PushApi
  {
    return new PushApi($provider);
  }

  /**
   * @param PushNotification $notification
   *
   * @return bool
   */
  public function send(PushNotification $notification): bool
  {
    return $this->provider->send($notification);
  }



}
