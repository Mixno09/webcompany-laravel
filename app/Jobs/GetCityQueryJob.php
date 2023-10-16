<?php

namespace App\Jobs;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;

class GetCityQueryJob
{
    use Dispatchable;

    public const ORDER_BY_ID = 'id';
    public const ORDER_BY_NAME = 'name';
    public const ORDER_BY_IDX = 'idx';
    public const ORDER_ASC = 'ASC';
    public const ORDER_DESC = 'DESC';
    public string $orderBy;
    public string $order;

    public function __construct(string $orderBy, string $order)
    {
        $this->orderBy = $orderBy;
        $this->order = $order;
    }

    public function handle(): Collection
    {
        $orderBy = match ($this->orderBy) {
            self::ORDER_BY_ID => 'id',
            self::ORDER_BY_NAME => 'name',
            default => 'idx',
        };

        $order = match ($this->order) {
            self::ORDER_DESC => 'DESC',
            default => 'ASC',
        };

        return City::query()->orderBy($orderBy, $order)->get();
    }

    public static function normalize(string $orderBy, string $order): array
    {
        if (! in_array($orderBy, [self::ORDER_BY_ID, self::ORDER_BY_IDX, self::ORDER_BY_NAME])) {
            $orderBy = self::ORDER_BY_IDX;
        }

        if (! in_array($order, [self::ORDER_ASC, self::ORDER_DESC])) {
            $order = self::ORDER_ASC;
        }

        $data['orderBy'] = $orderBy;
        $data['order'] = $order;

        return $data;
    }
}
