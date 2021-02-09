<?php

namespace App\MyApp\Message\Services;

use App\MyApp\Message\Repositories\MeetingRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class MessageService
{

    protected $fractal;
    protected $tranformsUtil;
    protected $messageRepository;


    public function __construct(MeetingRepository $messageRepository,
                                Manager $fractal,
                                TranformsUtil $tranformsUtil)
    {
        $this->messageRepository=$messageRepository;
        $this->fractal=$fractal;
        $this->tranformsUtil=$tranformsUtil;
    }

    public function getMessages(): JsonResponse
    {
        $allMessagesTransform=new Collection($this->messageRepository->getAll(), $this->tranformsUtil->getTransformer(7));
        return Response::build($this->fractal->createData($allMessagesTransform),200);
    }

    public function getMessageDetails($data): JsonResponse
    {
        $messageDetailsTransform=new Item($this->messageRepository->showMessage($data['id']), $this->tranformsUtil->getTransformer(8));
        return Response::build($this->fractal->createData($messageDetailsTransform),200);
    }



}
