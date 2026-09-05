<?php

namespace App\ApiClient;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Exceptions\DoctorApiException;

class DoctorApiClient
{
    private string $apiUrl;
    private string $cityId;
    private string $userIp;
    private string $userAgent;
    private const string SORTING = "score+";
    private const int TIMEOUT = 5;

    public function __construct(){
        $this->apiUrl = config('services.doctor.url');
        $this->cityId = config('services.doctor.cityId');
        $this->userIp = config('services.doctor.userIp');
        $this->userAgent = config('services.doctor.userAgent');
    }
    public function getDoctorsList(int $startFrom, int $pageSize): array
    {
        try{
            $response = Http::timeout(self::TIMEOUT)
                ->retry(2, 300)
                ->acceptJson()
                ->post($this->apiUrl, [
                    'metadata' => [
                        'user_ip' => $this->userIp,
                        'user_agent' => $this->userAgent,
                    ],
                    'city_id' => $this->cityId,
                    'sorting' => self::SORTING,
                    'start_from' => $startFrom,
                    'page_size' => $pageSize,
                ]);
        } catch (ConnectionException $e) {
            report($e);
            throw new DoctorApiException('Не удалось подключиться к API врачей.', previous: $e);
        }

        if ($response->failed()) {
            Log::error('Doctor API returned an error response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'start_from' => $startFrom,
                'page_size' => $pageSize,
            ]);

            throw new DoctorApiException(sprintf(
                'API врачей вернул ошибку (код %d): %s',
                $response->status(),
                $response->body()
            ));
        }

        $data = $response->json();

        if (!is_array($data)) {
            Log::error('Doctor API returned an unexpected response format', [
                'status' => $response->status(),
                'body' => $response->body(),
                'start_from' => $startFrom,
                'page_size' => $pageSize,
            ]);

            throw new DoctorApiException('API врачей вернул некорректный формат ответа.');
        }

        return $data;
    }
}
