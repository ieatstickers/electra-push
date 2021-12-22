<?php

namespace Electra\Push\Api;

use Electra\Core\Enum\Enum;

/**
 * @method static $this ANDROID
 * @method static $this IOS
 */
class DeviceTypeEnum extends Enum
{
  const ANDROID = 'android';
  const IOS = 'ios';

  /** @return bool */
  public function isAndroid(): bool
  {
    return $this->getValue() == self::ANDROID;
  }

  /** @return bool */
  public function isIos(): bool
  {
    return $this->getValue() == self::IOS;
  }
}
