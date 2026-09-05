<?php

namespace App\Interfaces;

interface DoctorProviderInterfaces
{
    /**
     * @return DoctorDTO[]
     */
    public function getDoctors(int $page, int $pageSize): array;
}
