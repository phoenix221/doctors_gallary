<?php

namespace App\ApiClient;

use App\Interfaces\DoctorProviderInterfaces;

class DoctorApiProvider implements DoctorProviderInterfaces
{
    public function __construct(
        private DoctorApiClient $doctorApiClient,
        private DoctorParser $doctorParser,
    ){}

    public function getDoctors(int $page, int $pageSize): array
    {
        $startFrom = ($page - 1) * $pageSize;
        $doctors = $this->doctorApiClient->getDoctorsList($startFrom, $pageSize);

        return $this->doctorParser->parse($doctors);
    }
}
