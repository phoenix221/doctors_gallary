<?php

namespace App\ApiClient;

use App\DTO\DoctorsDTO;
use App\Exceptions\DoctorParseException;

class DoctorParser
{
    private const string URL_PHOTO = 'https://api2.medicina-goroda.ru:8080/images/';

    public function parse(array $data): array
    {
        if (empty($data)) {
            throw new DoctorParseException(
                'API вернул пустой ответ.'
            );
        }

        if (!isset($data['data']['results']) || !is_array($data['data']['results'])){
            throw new DoctorParseException(
                'Некорректная структура ответа API.'
            );
        }

        $doctorsList = $data['data']['results'];
        $doctors = array_map(fn(array $row) => $this->mapDoctor($row), $doctorsList);

        return [
            'doctors' => $doctors,
            'total' => $data['data']['total_count'] ?? 0
        ];
    }

    private function mapDoctor(array $row): DoctorsDTO
    {
        $doctor = new DoctorsDTO();
        $doctor->name = $row['name'] ?? "";
        $doctor->profession = $row['profession'] ?? null;
        $doctor->lengthOfWork = (int) ($row['length_of_work'] ?? 0);
        $doctor->rating = (float) ($row['rating'] ?? 0);
        $doctor->reviewCount  = (int) ($row['review_count'] ?? 0);
        $doctor->category = $row['category'] ?? null;
        $doctor->academicDegree  = $row['academic_degree'] ?? null;
        if (isset($row['images'][0])){
            $doctor->image = self::URL_PHOTO . $row['images'][0];
        }

        return $doctor;
    }
}
