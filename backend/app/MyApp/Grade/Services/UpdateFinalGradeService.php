<?php

declare(strict_types=1);

namespace App\MyApp\Grade\Services;

use App\MyApp\Grade\Repositories\FinalGradeRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;

class UpdateFinalGradeService
{
    protected $userRepository;
    protected $finalGradeRepository;
    protected $subjectRepository;
    protected $fractal;
    protected $tranformsUtil;

    public function __construct(FinalGradeRepository $finalGradeRepository,
                                Manager $fractal,
                                TranformsUtil $tranformsUtil)
    {
        $this->finalGradeRepository = $finalGradeRepository;
        $this->fractal = $fractal;
        $this->tranformsUtil = $tranformsUtil;
    }

    public function execute($data): JsonResponse
    {
        try {
            $this->finalGradeRepository->updateFinalGrade($data);
            return Response::build([], 200, 'msg/success.update');
        } catch (\Exception $e) {
            Log::error("There was problem with UpdateFinalGradeService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.update');
        }
    }
}
