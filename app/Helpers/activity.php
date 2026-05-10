<?php

use App\Models\ActivityLog;

if (!function_exists('logActivity')) {

    function logActivity($action, $module, $description)
    {
        if (!auth()->check()) return;

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'module' => $module,
            'description' => $description,
        ]);
    }

}