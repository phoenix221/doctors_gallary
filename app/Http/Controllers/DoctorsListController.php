<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Service\DoctorListService;
use App\Exceptions\DoctorApiException;
use App\Exceptions\DoctorParseException;

class DoctorsListController extends Controller
{
    private const int PAGE_SIZE = 20;

    public function __construct(
        private DoctorListService $doctorsListService,
    ){
    }

    public function index(Request $request): View
    {
        $page = max(1, $request->integer('page', 1));

        try {
            $result = $this->doctorsListService->getDoctorsList($page, self::PAGE_SIZE);

            $response = new LengthAwarePaginator(
                $result['doctors'],
                $result['total'],
                self::PAGE_SIZE,
                $page,
                [
                    'path' => $request->url(),
                    'query' => $request->query(),
                ]
            );

            return view('doctorsList', [
                'response' => $response,
            ]);

        } catch (DoctorApiException $e) {
            report($e);

            return view('doctorsList', [
                'response' => $this->emptyPaginator($request, $page),
                'error' => 'Не удалось получить список врачей. Попробуйте позже.',
            ]);
        } catch (DoctorParseException $e) {
            report($e);

            return view('doctorsList', [
                'response' => $this->emptyPaginator($request, $page),
                'error' => 'Не удалось обработать данные врачей. Попробуйте позже.',
            ]);
        }
    }

    private function emptyPaginator(Request $request, int $page): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            [],
            0,
            self::PAGE_SIZE,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );
    }
}
