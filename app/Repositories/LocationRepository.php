<?php

namespace App\Repositories;

use App\Models\Location;
use App\Services\v1\Helper;

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
            $query->where('name', 'LIKE', '%' . $q . '%')
                ->orWhere('description', 'LIKE', '%' . $q . '%');
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

    public function existsLocation($name, $id = null)
    {
        $location = Location::where('name', $name)->get()->first();
        if (!is_null($location) and $location->id != $id) {
            return true;
        }
        return false;
    }

    public function store($params)
    {
        return Location::create($params);
    }

    public function get($id)
    {
        return Location::find($id)->load('image');
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
        return $this->get($id)->delete();
    }
}
