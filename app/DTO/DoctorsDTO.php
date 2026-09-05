<?php

namespace App\DTO;

class DoctorsDTO{
    public string $name = "";
    public ?string $profession = null;
    public int  $lengthOfWork = 0;
    public float $rating = 0;
    public int $reviewCount = 0;
    public ?string $category = null;
    public ?string $academicDegree = null;
    public string $image = "";
}
