<?php

namespace App\Core\YouTube;

use Google_Client;
use Google_Service_YouTube;
use Google_Service_Exception;
use Google_Exception;

use App\Exceptions\OAuthException;

class OAuthYoutubeClient
{
  private string $client_id;
  private string $client_secret;
  private string $redirect_url;
  private Google_Client $client;
  public function __construct()
  {
    $this->client_id = config('oauth.youtube.client_id');
    $this->client_secret = config('oauth.youtube.client_secret');
    $this->redirect_url = config('oauth.youtube.redirect_url');
    $client = new Google_Client();
    $client->getCache()->clear();         // トークンがメモリ？にキャッシュされてしまうのでリセットする
    $client->setClientId($this->client_id);
    $client->setClientSecret($this->client_secret);
    $client->setScopes(config('oauth.youtube.scope_one'));
    $client->setRedirectUri($this->redirect_url);
    $client->setAccessType('offline');    // リフレッシュトークンからアクセストークンを生成するために必要なオプション
    $client->setApprovalPrompt('force');  // リフッシュトークンを取得するために必要
    $client->setPrompt('consent');        // アプリとGoogleとを連携する時に毎回アクセス許可用の同意画面を表示させる
    $this->client = $client;
  }

  /**
   * 認可画面のURLを取得
   *
   * @return string
   */
  public function get_authorize_url(): string
  {
    return $this->client->createAuthUrl();
  }

  /**
   * アクセストークンをセット
   *
   * @param array{access_token: string, expires_in: int, refresh_token: string, scope: string}
   * @return void
   * @throws OAuthException
   */
  public function set_access_token(array $token): void
  {
    try {
      $this->client->setAccessToken($token);
    } catch (\Exception $th) {
      throw new OAuthException();
    }
  }

  /**
   * アクセストークンを取得
   *
   * @param string $code
   * @return array{access_token: string, expires_in: int, refresh_token: string, scope: string}
   */
  public function fetch_token(string $code): array
  {
    $token = $this->client->fetchAccessTokenWithAuthCode($code);
    return $token;
  }

  /**
   * アクセストークンの更新
   *
   * @param string $refresh_token
   * @return array{access_token: string, expires_in: int, refresh_token: string, scope: string}
   * @throws OAuthException
   */
  public function generate_token(string $refresh_token): array
  {
    try {
      $token = $this->client->fetchAccessTokenWithRefreshToken($refresh_token);
    } catch (\Exception $th) {
      throw new OAuthException();
    }
    return $token;
  }

  /**
   * Youtubeサービス作成
   *
   * @return Google_Service_YouTube
   */
  public function generate_youtube_service(): Google_Service_YouTube
  {
    return new Google_Service_YouTube($this->client);
  }

  /**
   * トークンの有効期限切れチェック
   *
   * @return boolean
   */
  public function is_access_token_expired(): bool
  {
    return $this->client->isAccessTokenExpired();
  }
}