<?php

namespace App\UseCase\YouTube;

use App\Exceptions\OAuthException;
// core
use App\Core\YouTube\OAuthYoutubeClient;
// usecase
use App\UseCase\Authentication\MeAction;

class GenerateAccessTokenAction
{
  private OAuthYoutubeClient $client;
  private MeAction $me_action;
  public function __construct(OAuthYoutubeClient $client, MeAction $me_action)
  {
    $this->client = $client;
    $this->me_action = $me_action;
  }

  /**
   * Undocumented function
   *
   * @return array{access_token: string, expires_in: int, scope: string}|null
   * @throws OAuthException
   */
  public function generate(): ?array
  {
    $user = $this->me_action->me();
    if (!$user) return null;
    $youtube_token = $user->youtube_token;
    if (!$youtube_token) return null;
    // リフレッシュトークンからアクセストークンを生成
    $token = $this->client->generate_token($youtube_token->refresh_token);
    unset($token['refresh_token']);
    return $token;
  }
}