<?php

namespace App\Service;

use App\Interfaces\DoctorProviderInterfaces;

class DoctorListService
{
    public function __construct(
        private DoctorProviderInterfaces $doctorProvider,
    ){

    }

    public function getDoctorsList(int $page, int $pageSize): array
    {
        $page = max(1, $page);
        $pageSize = max(1, $pageSize);

        return $this->doctorProvider->getDoctors($page, $pageSize);
    }
}
