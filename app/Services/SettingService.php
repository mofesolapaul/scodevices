<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SettingService
{
    public function put($label, $value)
    {
        DB::table('settings')->updateOrInsert(
            ['label' => $label],
            ['value' => $value]
        );
    }

    public function get($label)
    {
        $data = DB::table('settings')->where('label', '=', $label)->first();
        if ($data) {
            return $data->value;
        }
        return null;
    }
}
