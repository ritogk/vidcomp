import { computed } from "vue"
import { IVideoPlayer, VideoType, Status } from "./IVideoPlayer"

export class DummyPlayer implements IVideoPlayer {
  get videoType() {
    return VideoType.NONE
  }

  load = async () => {
    return Promise.resolve()
  }

  changeVideo(url: string): void {}

  play = () => {
    return Promise.resolve()
  }

  stop = async () => {
    return Promise.resolve()
  }

  mute = () => {
    return Promise.resolve()
  }

  unMute = () => {
    return
  }

  adjustSpeed = (speed: number) => {
    return
  }

  enableRepeat = () => {
    return
  }

  disableRepeat = () => {
    return
  }

  seekTo = async (seconds: number) => {
    return Promise.resolve()
  }

  getCurrentPosition = async (): Promise<number> => {
    return 1
  }

  setCurrentPosition = (currentPosition: number) => {
    return
  }

  getDuration = async (): Promise<number> => {
    return 1
  }

  async destory(): Promise<void> {
    return
  }

  getVideoType = (): VideoType => {
    return VideoType.NONE
  }

  getPath = (): Promise<string> => {
    return Promise.resolve("")
  }

  get subscription() {
    return {
      status: computed(() => {
        return Status.WAITING
      }),
    }
  }
}
