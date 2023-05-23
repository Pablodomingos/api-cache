<?php

namespace App\Models;

use App\Traits\FillableColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $url
 * @property string|null $description
 * @property int $module_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Module $module
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUuid($value)
 * @mixin \Eloquent
 */
class Lesson extends Model
{
    use HasFactory, FillableColumns;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
