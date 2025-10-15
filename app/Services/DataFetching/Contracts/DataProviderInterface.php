<?php

namespace App\Services\DataFetching\Contracts;

interface DataProviderInterface
{

    public function fetchData(): array;
}
