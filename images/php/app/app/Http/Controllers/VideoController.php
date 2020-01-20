<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\VideoService;

class VideoController extends Controller
{
    use ApiResponser;

    /**
    * The service to consume the video microservice
    * @var VideoService
    */
    public $videoService;

    /**
    * Create a new controller instance.
    * @return void
    */
    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    /**
    * FRONT END
    * Fetch the video view
    * @return Illuminate\Http\Response
    */
    public function views(Request $request, $video)
    {
        $session = $request->session();
        $auth = $session->get('auth');

        if($auth == 'yes'){

           return $this->videoService->viewsVideo($video);
        } else {

           return redirect()->route('logins');
        }
    }

    /**
    * BACK END
    * Return the list of videos
    * @return Illuminate\Http\Response
    */
    public function index()
    {
        return $this->successResponse($this->videoService->obtainVideos());
    }

    /**
    * Create one new video
    * @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
       return $this->successResponse($this->videoService->
                          createVideo($request->all(),
                          Response::HTTP_CREATED
                          ));
    }

    /**
    * Obtains and shows one video
    * @return Illuminate\Http\Response
    */
    public function show($video)
    {
       return $this->successResponse($this->videoService->obtainVideo($video));
    }

    /**
    * Update an existing video
    * @return Illuminate\Http\Response
    */
    public function update(Request $request, $video)
    {
       return $this->successResponse($this->videoService->editVideo(
                                $request->all(), $video));
    }

    /**
    * Remove an existing video
    * @return Illuminate\Http\Response
    */
    public function destroy($video)
    {
       return $this->successResponse($this->videoService->deleteVideo($video));
    }
}
