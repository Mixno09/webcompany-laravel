<?php

namespace App\Jobs;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;

class GetUserQueryJob
{
    use Dispatchable;

    public const ORDER_BY_ID = 'id';
    public const ORDER_BY_NAME = 'name';
    public const ORDER_BY_SURNAME = 'surName';
    public const ORDER_ASC = 'ASC';
    public const ORDER_DESC = 'DESC';

    public function __construct(
        public string $orderBy,
        public string $order,
        public int $cityId,
    ) {}

    public function handle(): Collection
    {
        $orderBy = match ($this->orderBy) {
            self::ORDER_BY_NAME => 'name',
            self::ORDER_BY_SURNAME => 'surName',
            default => 'id',
        };

        $order = match ($this->order) {
            self::ORDER_DESC => 'DESC',
            default => 'ASC',
        };

        $users = UserModel::query()->orderBy($orderBy, $order)->get();

        if ($this->cityId !== 0) {
            $users = UserModel::query()->where('city_id', $this->cityId)->get();
        }

        return $users;
    }

    public static function normalize(string $orderBy, string $order, int $cityId): array
    {
        if (! in_array($orderBy, [self::ORDER_BY_ID, self::ORDER_BY_NAME, self::ORDER_BY_SURNAME])) {
            $orderBy = self::ORDER_BY_ID;
        }

        if (! in_array($order, [self::ORDER_ASC, self::ORDER_DESC])) {
            $order = self::ORDER_ASC;
        }

        $data['orderBy'] = $orderBy;
        $data['order'] = $order;

        if ($cityId === 0) {
            $data['cityId'] = 0;
        } else {
            $data['cityId'] = $cityId;
        }

        return $data;
    }
}
