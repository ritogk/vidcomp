import { IVideoPlayer, VideoType } from "./IVideoPlayer";
import YPlayer from "youtube-player";
import { YouTubePlayer as YouTubePlayerType } from "node_modules/@types/youtube-player/dist/types";

export class YouTubePlayer implements IVideoPlayer {
  private player: YouTubePlayerType;
  constructor(elementId: string, youtubeUrl: string) {
    this.player = YPlayer(elementId);
    this.player.loadVideoByUrl(youtubeUrl);
  }

  play = () => {
    this.player.playVideo();
  };

  stop = () => {
    this.player.pauseVideo();
  };

  mute = () => {
    this.player.mute();
  };

  unMute = () => {
    this.player.unMute();
  };

  adjustSpeed = (speed: number) => {
    return;
  };

  enableRepeat = () => {
    return;
  };

  disableRepeat = () => {
    return;
  };

  seekTo = async (seconds: number) => {
    this.player.seekTo(seconds, true);
  };

  getCurrentPosition = async (): Promise<number> => {
    return this.player.getCurrentTime();
  };

  setCurrentPosition = (currentPosition: number) => {};

  destory(): Promise<void> {
    return this.player.destroy();
  }

  getVideoType = (): VideoType => {
    return VideoType.YOUTUBE;
  };
}
