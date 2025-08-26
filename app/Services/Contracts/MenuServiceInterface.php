<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface MenuServiceInterface
{
    public function list(?int $categoryId = null, array $tags = []): Collection;
}
