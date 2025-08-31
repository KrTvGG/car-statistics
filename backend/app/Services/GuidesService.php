<?php

namespace App\Services;

use App\Repositories\GuidesRepository;

class GuidesService
{
    private $guidesRepository;

    public function __construct(GuidesRepository $guidesRepository)
    {
        $this->guidesRepository = $guidesRepository;
    }

    public function list(): array
    {
        return $this->guidesRepository->list();
    }
}
