<?php

namespace App\Jobs\Videos;

use Illuminate\Support\Facades\Storage;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class CreateVideoThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        FFmpeg::fromDisk('local')
        ->open($this->video->path)
        ->getFrameFromSeconds(1)
        ->export()
        ->toDisk('local')
        ->save("public/thumbnails/{$this->video->id}.png");

        $this->video->update([
            'thumbnail'=>Storage::url("public/thumbnails/{$this->video->id}.png")
        ]);
    }
}
