<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;

trait AuditableTrait
{
    public static function bootAuditableTrait()
    {
        static::updated(function (Model $model) {
            if (auth()->check()) {
                $oldValues = array_diff_assoc($model->getOriginal(), $model->getAttributes());
                $newValues = array_intersect_key($model->getAttributes(), $oldValues);

                AuditLog::logAction(
                    'update',
                    class_basename($model),
                    $model->id,
                    $oldValues,
                    $newValues
                );
            }
        });

        static::deleted(function (Model $model) {
            if (auth()->check()) {
                AuditLog::logAction(
                    'delete',
                    class_basename($model),
                    $model->id,
                    $model->getAttributes(),
                    null
                );
            }
        });

        static::created(function (Model $model) {
            if (auth()->check()) {
                AuditLog::logAction(
                    'create',
                    class_basename($model),
                    $model->id,
                    null,
                    $model->getAttributes()
                );
            }
        });
    }
}
