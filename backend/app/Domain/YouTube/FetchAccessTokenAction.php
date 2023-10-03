<?php

namespace App\Domain\YouTube;

use App\Core\YouTube\IOAuthYoutubeClient;
use App\Core\YouTube\TokenValue;
// Domain
use App\Domain\Authentication\GetMeAction;
use App\Domain\YouTube\SaveRefreshTokenAction;

class FetchAccessTokenAction
{
  private IOAuthYoutubeClient $client;
  private GetMeAction $me_action;
  private SaveRefreshTokenAction $save_token_action;
  public function __construct(IOAuthYoutubeClient $client, GetMeAction $me_action, SaveRefreshTokenAction $save_token_action)
  {
    $this->client = $client;
    $this->me_action = $me_action;
    $this->save_token_action = $save_token_action;
  }

  /**
   * fetch
   *
   * @param string $code
   * @return TokenValue
   */
  public function fetch(string $code): TokenValue
  {
    $token = $this->client->fetch_token($code);
    $user = $this->me_action->me();
    if ($user) {
      $this->save_token_action->save($user->id, $token->refresh_token);
    }
    return $token;
  }
}
