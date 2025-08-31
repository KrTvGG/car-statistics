<?php
namespace App\Repositories\Interfaces;

use App\Models\Guides;
use App\DTOs\CreateGuideDto;

interface GuidesRepositoryInterface
{
    /**
     * Вывод всех Guide.
     * @return Guides
     */
    public function list(): Guides;

    /**
     * Создать запись Guide.
     *
     * @param CreateGuideDto $dto
     * @return Guides
     */
    public function create(CreateGuideDto $dto): Guides;
}