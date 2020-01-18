<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class VideoService
{
    use ConsumesExternalService;

    /**
    * The base uri to consume the video service
    * @var string
    */
    public $baseUri;

    public function __construct()
    {
       $this->baseUri = config('services.videos.base_uri');
    }

    /**
    * Obtain the view from the catalogue service
    * @return string
    */
    public function viewsVideo($video)
    {
        return $this->performRequest('GET',"/videos1/{$video}");
    }

    /**
    * Obtain the full list of videos from the video service
    * @return string
    */
    public function obtainVideos()
    {
        return $this->performRequest('GET','/videos');
    }

    /**
    * Create one video from the video service
    * @return string
    */
    public function createVideo($data)
    {
        return $this->performRequest('POST','/videos', $data);
    }

    /**
    * Obtain one video from the video service
    * @return string
    */
    public function obtainVideo($video)
    {
        return $this->performRequest('GET',"/videos/{$video}");
    }

    /**
    * Update one instance of video from the video service
    * @return string
    */
    public function editVideo($data, $video)
    {
        return $this->performRequest('PUT',"/videos/{$video}",
                                 $data);
    }

    /**
    * Remove one video from the video service
    * @return string
    */
    public function deleteVideo($video)
    {
        return $this->performRequest('DELETE',"/videos/{$video}");
    }
}
