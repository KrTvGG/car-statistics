<?php

namespace App\Repositories;

use App\DTOs\CreateGuideDto;
use App\Models\Guides;
use App\Repositories\Interfaces\GuidesRepositoryInterface;

class GuidesRepository implements GuidesRepositoryInterface
{
    public function list(): Guides
    {
        $guides = Guides::select([
                'id',
                'make',
                'model',
                'year',
                'body_type',
                'engine_type',
                'engine_capacity',
                'power',
                'transmission',
                'drive_type'
            ])
            ->get();

        return $guides;
    }

    public function create(CreateGuideDto $dto): Guides
    {
        return Guides::create($dto->toArray());
    }
}
