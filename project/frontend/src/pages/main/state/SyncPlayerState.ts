import { ref, computed, ComputedRef } from "vue"
import {
  IVideoPlayer,
  Status,
} from "@/pages/main/parts/video-area-parts/libs/IVideoPlayer"
import { PlayerManager } from "@/pages/main/parts/video-area-parts/libs/PlayerManager"

export interface ISyncPlayerStateType {
  playerOneManager: PlayerManager
  playerTwoManager: PlayerManager
  switchPlay(): void
  switchMute(): void
  switchRepeat(): void
  adjustSpeed(speed: number): void
  reload(): void
  runSync(): void
  stopSync(): void
  enableSync(): void
  disableSync(): void
  seekTo(progressRate: number): Promise<void>
  subscription: {
    videoOwn: ComputedRef<IVideoPlayer>
    videoTwo: ComputedRef<IVideoPlayer>
    playing: ComputedRef<boolean>
    muted: ComputedRef<boolean>
    repeated: ComputedRef<boolean>
    speed: ComputedRef<number>
    synced: ComputedRef<boolean>
    progressRate: ComputedRef<number>
    duration: ComputedRef<number>
  }
}

export class SyncPlayerState implements ISyncPlayerStateType {
  private _playerOneManager: PlayerManager
  private _playerOneStartPosition = 0
  private _playerTwoManager: PlayerManager
  private _playerTwoStartPosition = 0
  private _syncDuration = ref(0)
  private _syncProgressRate = ref(0)
  private _playing = ref(false)
  private _muted = ref(true)
  private _repeated = ref(false)
  private _speed = ref(1)
  private _synced = ref(false)
  private _syncIntervalId = 0

  constructor() {
    this._playerOneManager = new PlayerManager()
    this._playerTwoManager = new PlayerManager()
  }

  get playerOneManager() {
    return this._playerOneManager
  }

  get playerTwoManager() {
    return this._playerTwoManager
  }

  switchPlay = async () => {
    this._playing.value = !this._playing.value
    if (this._playing.value) {
      this._playerOneManager.subscription.player.value.play()
      this._playerTwoManager.subscription.player.value.play()
    } else {
      await Promise.all([
        this._playerOneManager.subscription.player.value.stop(),
        this._playerTwoManager.subscription.player.value.stop(),
      ])
    }
    return
  }

  switchMute = (): void => {
    this._muted.value = !this._muted.value
    if (this._muted.value) {
      this._playerOneManager.subscription.player.value.mute()
      this._playerTwoManager.subscription.player.value.mute()
    } else {
      this._playerOneManager.subscription.player.value.unMute()
      this._playerTwoManager.subscription.player.value.unMute()
    }
  }

  switchRepeat = (): void => {
    this._repeated.value = !this._repeated.value
  }

  adjustSpeed = (speed: number): void => {
    this._speed.value = speed
    this._playerOneManager.subscription.player.value.adjustSpeed(speed)
    this._playerTwoManager.subscription.player.value.adjustSpeed(speed)
  }

  switchSync = () => {
    this._synced.value = !this._synced.value
  }

  reload = async () => {
    await this._playerOneManager.subscription.player.value.mute()
    await this._playerTwoManager.subscription.player.value.mute()
    this._muted.value = true
    await this._playerOneManager.subscription.player.value.stop()
    await this._playerTwoManager.subscription.player.value.stop()
    this._playing.value = false
    await this._playerOneManager.subscription.player.value.seekTo(
      this._playerOneStartPosition
    )
    await this._playerTwoManager.subscription.player.value.seekTo(
      this._playerTwoStartPosition
    )
    await this._playerOneManager.subscription.player.value.play()
    await this._playerTwoManager.subscription.player.value.play()
    this._playing.value = true
  }

  private syncProcessing = false // 処理中フラグ
  runSync = async () => {
    this._playing.value = false
    await Promise.all([
      this._playerOneManager.subscription.player.value.stop(),
      this._playerTwoManager.subscription.player.value.stop(),
    ])
    const [playerOneStartPosition, playerTwoStartPosition] = await Promise.all([
      this._playerOneManager.subscription.player.value.getCurrentPosition(),
      this._playerTwoManager.subscription.player.value.getCurrentPosition(),
    ])
    this._playerOneStartPosition =
      Math.floor(playerOneStartPosition * 100) / 100
    this._playerTwoStartPosition =
      Math.floor(playerTwoStartPosition * 100) / 100

    // 動画1と動画2で同期した時間の範囲を算出
    const playerOneDuration =
      await this._playerOneManager.subscription.player.value.getDuration()
    const playerTwoDuration =
      await this._playerTwoManager.subscription.player.value.getDuration()
    const playerOneRange = playerOneDuration - this._playerOneStartPosition
    const playerTwoRange = playerTwoDuration - this._playerTwoStartPosition
    playerOneRange > playerTwoRange
      ? (this._syncDuration.value = playerTwoRange)
      : (this._syncDuration.value = playerOneRange)

    // 1倍速に戻す
    this.adjustSpeed(1)

    this._synced.value = true

    // 同期ぐるぐる
    this._syncIntervalId = setInterval(async () => {
      if (this.syncProcessing) return
      this.syncProcessing = true

      const st = new Date().getTime()
      let [playerOneCurrentPosition, playerTwoCurrentPosition] =
        await Promise.all([
          this._playerOneManager.subscription.player.value.getCurrentPosition(),
          this._playerTwoManager.subscription.player.value.getCurrentPosition(),
        ])
      playerOneCurrentPosition =
        Math.floor(playerOneCurrentPosition * 100) / 100
      playerTwoCurrentPosition =
        Math.floor(playerTwoCurrentPosition * 100) / 100
      // 動画が再生しきっていてリピートフラグが立っている場合はリロード
      if (
        (this._playerOneManager.subscription.player.value.subscription.status
          .value === Status.ENDED ||
          this._playerTwoManager.subscription.player.value.subscription.status
            .value === Status.ENDED) &&
        this._repeated.value
      ) {
        console.log(
          "動画が再生しきっていてリピートフラグが立っている場合はリロード"
        )
        this.reload()
        this.syncProcessing = false
        return
      }

      if (
        playerOneCurrentPosition < this._playerOneStartPosition ||
        playerTwoCurrentPosition < this._playerTwoStartPosition
      ) {
        // 開始ポジションより手前の場合は開始ポジションに戻す
        console.log("開始ポジションより手前の場合は開始ポジションに戻す")
        // console.log(
        //   `playerOneCurrentPosition:${playerOneCurrentPosition} playerOneStartPosition:${this._playerOneStartPosition}`
        // )
        // console.log(
        //   `playerTwoCurrentPosition:${playerTwoCurrentPosition} playerTwoStartPosition:${this._playerTwoStartPosition}`
        // )
        this.reload()
        this.syncProcessing = false
        return
      }

      const videoOwnPosition =
        playerOneCurrentPosition - this._playerOneStartPosition
      const videoTwoPosition =
        playerTwoCurrentPosition - this._playerTwoStartPosition
      // 0.1秒以上ずれていたら同期させる
      const diff = Math.abs(videoOwnPosition - videoTwoPosition)
      if (diff >= 0.1) {
        console.log("0.1秒以上ずれていたら同期させる")
        if (videoOwnPosition > videoTwoPosition) {
          this._playerOneManager.subscription.player.value.seekTo(
            playerOneCurrentPosition + diff * -1
          )
          // 片方の動画のみをシークすると「シークのタイムラグ」と「再生され続けている時間」をあわせて0.4秒くらいずれてしまうので意味のないシークを挟む
          // なぜかcurrentPositionより前にシークする時がある。
          this._playerTwoManager.subscription.player.value.seekTo(
            playerTwoCurrentPosition
          )
        } else {
          this._playerOneManager.subscription.player.value.seekTo(
            playerOneCurrentPosition
          )
          this._playerTwoManager.subscription.player.value.seekTo(
            playerTwoCurrentPosition + diff * -1
          )
        }
      }

      // 再生完了率を取得
      this._syncProgressRate.value = videoOwnPosition / this._syncDuration.value
      this.syncProcessing = false
    }, 500)
  }

  enableSync(): void {
    this.syncProcessing = false
  }

  disableSync(): void {
    this.syncProcessing = true
  }

  stopSync = (): void => {
    this._synced.value = false
    clearInterval(this._syncIntervalId)
    this._syncIntervalId = 0
  }

  seekTo = async (progressRate: number) => {
    this._syncProgressRate.value = progressRate
    // ミュート
    await this._playerOneManager.subscription.player.value.mute()
    await this._playerTwoManager.subscription.player.value.mute()
    this._muted.value = true

    // シーク
    const playerOneRange =
      (await this._playerOneManager.subscription.player.value.getDuration()) -
      this._playerOneStartPosition
    const playerTwoRange =
      (await this._playerTwoManager.subscription.player.value.getDuration()) -
      this._playerTwoStartPosition
    this._playerOneManager.subscription.player.value.seekTo(
      this._playerOneStartPosition + playerOneRange * progressRate
    )
    this._playerTwoManager.subscription.player.value.seekTo(
      this._playerTwoStartPosition + playerTwoRange * progressRate
    )
  }

  get subscription() {
    return {
      videoOwn: computed(() => {
        return this._playerOneManager.subscription.player.value
      }),
      videoTwo: computed(() => {
        return this._playerTwoManager.subscription.player.value
      }),
      playing: computed(() => {
        return this._playing.value
      }),
      muted: computed(() => {
        return this._muted.value
      }),
      repeated: computed(() => {
        return this._repeated.value
      }),
      speed: computed(() => {
        return this._speed.value
      }),
      synced: computed(() => {
        return this._synced.value
      }),
      progressRate: computed(() => {
        return this._syncProgressRate.value
      }),
      duration: computed(() => {
        return this._syncDuration.value
      }),
    }
  }
}
