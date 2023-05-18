<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait FillableColumns
{
    public function getFillable()
    {
        return Schema::getColumnListing($this->getTable());
    }
}
