<?php

namespace Electra\Push\Api\Provider\FirebaseCloudMessaging;

use Electra\Push\Api\PushNotification;
use Electra\Push\Api\Provider\PushNotificationProviderInterface;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseCloudMessagingProvider implements PushNotificationProviderInterface
{
  /** @var Factory */
  private $client;

  /** @param Factory $client */
  private function __construct(Factory $client)
  {
    $this->client = $client;
  }

  public static function init(array $serviceAccountConfig): PushNotificationProviderInterface
  {
    $client = (new Factory())->withServiceAccount($serviceAccountConfig);
    return new FirebaseCloudMessagingProvider($client);
  }

  /**
   * @param PushNotification $notification
   *
   * @return bool
   * @throws FirebaseException
   * @throws MessagingException
   */
  public function send(PushNotification $notification): bool
  {
    $response = $this
      ->client
      ->createMessaging()
      ->send($this->getMessage($notification));

    return isset($response['name']) && is_string($response['name']);
  }

  private function getMessage(PushNotification $notification): CloudMessage
  {
    if ($notification->getDeviceType()->isAndroid())
    {
      $config = AndroidConfig::fromArray([
        'priority' => 'high',
        'notification' => [
          'title' => $notification->getTitle(),
          'body' => $notification->getBody(),
        ],
        'data' => [
          'subtitle' => $notification->getSubtitle(),
          'category' => $notification->getCategory()
        ]
      ]);

      return CloudMessage::withTarget('token', $notification->getDeviceToken())->withAndroidConfig($config);
    }

    $apnsConfig = [
      'headers' => [
        'apns-priority' => '10',
      ],
      'payload' => [
        'aps' => [
          "mutable-content" => 1,
          'alert' => [
            'title' => $notification->getTitle(),
            'body' => $notification->getBody()
          ],
          'category' => $notification->getCategory(),
          'data' => [

          ]
        ],
      ],
    ];

    if ($notification->getSubtitle())
    {
      $apnsConfig['payload']['aps']['alert']['subtitle'] = $notification->getSubtitle();
    }

    $config = ApnsConfig::fromArray($apnsConfig);

    return CloudMessage::withTarget('token', $notification->getDeviceToken())->withApnsConfig($config);
  }

}
