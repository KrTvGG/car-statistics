<?php

namespace App\DTOs;

use Illuminate\Http\Request;

/**
 * DTO для создания записи guides.
 *
 * @psalm-immutable
 */
final class CreateGuideDto
{
    /**
     * @param string $make Производитель
     * @param string $model Модель
     * @param int $year Год выпуска
     * @param float $engine_capacity Объём двигателя
     * @param int $power Мощность
     * @param string|null $body_type Тип кузова
     * @param string|null $engine_type Тип двигателя
     * @param string|null $transmission Тип трансмиссии
     * @param string|null $drive_type Тип привода
     */
    public function __construct(
        public string $make,
        public string $model,
        public int $year,
        public float $engine_capacity,
        public int $power,
        public ?string $body_type = null,
        public ?string $engine_type = null,
        public ?string $transmission = null,
        public ?string $drive_type = null,
    ) {}

    /**
     * Создать DTO из массива (например, $request->only(...)).
     *
     * @param array<string,mixed> $data
     * @return self
     * @throws \InvalidArgumentException если обязательные поля отсутствуют
     */
    public static function fromArray(array $data): self
    {
        return new self(
            make: (string) ($data['make'] ?? throw new \InvalidArgumentException('make is required')),
            model: (string) ($data['model'] ?? throw new \InvalidArgumentException('model is required')),
            year: (int) ($data['year'] ?? throw new \InvalidArgumentException('year is required')),
            engine_capacity: isset($data['engine_capacity']) ? (float) $data['engine_capacity'] : throw new \InvalidArgumentException('engine_capacity is required'),
            power: (int) ($data['power'] ?? throw new \InvalidArgumentException('power is required')),
            body_type: array_key_exists('body_type', $data) ? ($data['body_type'] !== null ? (string) $data['body_type'] : null) : null,
            engine_type: array_key_exists('engine_type', $data) ? ($data['engine_type'] !== null ? (string) $data['engine_type'] : null) : null,
            transmission: array_key_exists('transmission', $data) ? ($data['transmission'] !== null ? (string) $data['transmission'] : null) : null,
            drive_type: array_key_exists('drive_type', $data) ? ($data['drive_type'] !== null ? (string) $data['drive_type'] : null) : null,
        );
    }

    /**
     * Создать DTO из Illuminate\Http\Request.
     */
    public static function fromRequest(Request $request): self
    {
        return self::fromArray($request->only([
            'make','model','year','engine_capacity','power',
            'body_type','engine_type','transmission','drive_type',
        ]));
    }

    /**
     * Преобразовать в массив для массового присвоения модели.
     *
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'engine_capacity' => $this->engine_capacity,
            'power' => $this->power,
            'body_type' => $this->body_type,
            'engine_type' => $this->engine_type,
            'transmission' => $this->transmission,
            'drive_type' => $this->drive_type,
        ];
    }
}
