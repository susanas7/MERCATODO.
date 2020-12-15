<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Paginator
{
    /**
     * Get a collection paginated.
     *
     * @param Request $request
     * @param Collection $collection
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public static function paginate(Request $request, Collection $collection, int $perPage = 15)
    {
        $page = $request->input('page', 1);

        return new LengthAwarePaginator(
            $collection->forPage($page, $perPage), $collection->count(), $perPage, $page
        );
    }
}
