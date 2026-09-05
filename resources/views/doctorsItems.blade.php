<div class="card" style="width: 18rem;">
    @if ($doctor->image)
        <img src="{{ $doctor->image }}" class="card-img-top" alt="{{ $doctor->name ?: 'Фото врача' }}">
    @else
        <img src="/picture/default-avatar.png" class="card-img-top" alt="{{ $doctor->name ?: 'Фото врача' }}">
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $doctor->name ?: 'Имя не указано' }}</h5>
        @if ($doctor->profession)
            <p class="card-text">Специальность: {{ $doctor->profession }}</p>
        @endif
        @if ($doctor->lengthOfWork)
            <p class="card-text">Стаж: {{ $doctor->lengthOfWork }}</p>
        @endif
        @if ($doctor->rating)
            <p class="card-text">Рейтинг: {{ $doctor->rating }}</p>
        @endif
        @if ($doctor->reviewCount)
            <p class="card-text">Количество отзывов: {{ $doctor->reviewCount }}</p>
        @endif
        @if ($doctor->category)
            <p class="card-text">Категория: {{ $doctor->category }}</p>
        @endif
        @if ($doctor->academicDegree)
            <p class="card-text">Ученая степень: {{ $doctor->academicDegree }}</p>
        @endif
    </div>
</div>
