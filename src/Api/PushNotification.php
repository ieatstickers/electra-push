<?php

namespace Electra\Push\Api;

class PushNotification
{
  /** @var DeviceTypeEnum */
  private $deviceType;
  /** @var string */
  private $deviceToken;
  /** @var string */
  private $title;
  /** @var string */
  private $subtitle;
  /** @var string */
  private $body;
  /** @var string */
  private $category = 'default';

  private function __construct()
  {}

  /**
   * @param DeviceTypeEnum $deviceType
   * @param string         $deviceToken
   * @param string         $title
   * @param string         $body
   *
   * @return PushNotification
   */
  public static function create(
    DeviceTypeEnum $deviceType,
    string $deviceToken,
    string $title,
    string $body
  ): PushNotification
  {
    return (new PushNotification())
      ->setDeviceType($deviceType)
      ->setDeviceToken($deviceToken)
      ->setTitle($title)
      ->setBody($body);
  }

  /**
   * @return DeviceTypeEnum
   */
  public function getDeviceType(): DeviceTypeEnum
  {
    return $this->deviceType;
  }

  /**
   * @param DeviceTypeEnum $deviceType
   *
   * @return $this
   */
  public function setDeviceType(DeviceTypeEnum $deviceType)
  {
    $this->deviceType = $deviceType;
    return $this;
  }

  /**
   * @return string
   */
  public function getDeviceToken(): string
  {
    return $this->deviceToken;
  }

  /**
   * @param string $deviceToken
   *
   * @return $this
   */
  public function setDeviceToken(string $deviceToken)
  {
    $this->deviceToken = $deviceToken;
    return $this;
  }

  /**
   * @return string
   */
  public function getTitle(): string
  {
    return $this->title;
  }

  /**
   * @param string $title
   *
   * @return $this
   */
  public function setTitle(string $title)
  {
    $this->title = $title;
    return $this;
  }

  /** @return string|null */
  public function getSubtitle(): ?string
  {
    return $this->subtitle;
  }

  /**
   * @param string $subtitle
   *
   * @return $this
   */
  public function setSubtitle(string $subtitle)
  {
    $this->subtitle = $subtitle;
    return $this;
  }

  /** @return string */
  public function getBody(): string
  {
    return $this->body;
  }

  /**
   * @param string $body
   *
   * @return $this
   */
  public function setBody(string $body)
  {
    $this->body = $body;
    return $this;
  }

  /** @return string */
  public function getCategory(): string
  {
    return $this->category;
  }

  /**
   * @param string $category
   *
   * @return $this
   */
  public function setCategory(string $category)
  {
    $this->category = $category;
    return $this;
  }

}
