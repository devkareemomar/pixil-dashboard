<?php

namespace App\Helpers;

class DeleteRow
{
    public static function helperDeleteSelectedRows($modelClassName, $selectedIds)
    {
        $model = app($modelClassName);
        if (empty($selectedIds)) {
            return;
        }

        if(method_exists($model, 'getUniqueColumns')) {
            $columns = $model->getUniqueColumns();
        }else{
            $columns = [];
        }

        foreach ($model->whereIn('id', $selectedIds)->get() as $instance) {
            foreach ($columns as $column) {
                $instance->update([
                    $column => time() . '::' . $instance->{$column}
                ]);
            }
        }

        $model->whereIn('id', $selectedIds)->delete();

    }
}
