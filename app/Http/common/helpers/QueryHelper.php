<?php

function scopeOrWhereLike($query, $columns, $keywords)
{
    $query->where(function ($subQuery) use ($columns, $keywords) {
        foreach ($columns as $column) {
            $subQuery->orWhere($column, 'like', '%' . $keywords . '%');
        }
    });
    return $query;
}
