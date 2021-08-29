<?php

namespace App\Repositories;

use App\Models\Location;
use App\Services\v1\Helper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LocationController;
use Carbon\Carbon;

class LocationRepository
{
    public function indexPaginate($params)
    {
        $per_page = $params['per_page'] ?? 10;
        $locations = $this->prepareQuery($params)->paginate($per_page);
        return $locations;
    }

    public function prepareQuery($params)
    {
        $query = Location::with('image');
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrder($query, $params);
        return $query;
    }

    public function queryApplyFilter($query, $params)
    {
        $q = $params['q'] ?? null;
        $type = $params['type'] ?? null;
        $dimension = $params['dimension'] ?? null;

        if (Helper::isNotEmptyString($q)) {
            $query->where(function ($subQuery) use ($q) {
                $subQuery->where('name', 'LIKE', '%' . $q . '%')
                    ->orWhere('description', 'LIKE', '%' . $q . '%');
            });
        }
        if (Helper::isNotEmptyArray($type)) {
            $query->whereIn('type', $type);
        }
        if (Helper::isNotEmptyArray($dimension)) {
            $query->whereIn('dimension', $dimension);
        }
        return $query;
    }

    public function queryApplyOrder($query, $params)
    {
        $sort = $params['sort'] ?? 'id';
        $sort_way = $params['sort_way'] ?? 'asc';

        if (Helper::isNotEmptyString($sort)) {
            $query->orderBy($sort, $sort_way);
        }
        return $query;
    }

    public function store($params)
    {
        return Location::create($params);
    }

    public function get($id)
    {
        return Location::find($id);
    }

    public function update($params, $id)
    {
        $location = $this->get($id);
        $location->fill($params);
        $location->save();

        return $location;
    }

    public function destroy($id)
    {
        return Location::destroy($id);
    }

    public function setImage($id, $path)
    {
        return Location::find($id)->image()->create(['path' => $path]);
    }

    public function getImage($id)
    {
        return Location::find($id)->image;
    }

    public function deleteImage($id)
    {
        $deleted_at = Carbon::now()->toDateTimeString();
        return DB::table('images')
            ->where('imageable_type', 'App\Models\Location')
            ->where('imageable_id', $id)
            ->update(['deleted_at' => $deleted_at]);
    }
}
