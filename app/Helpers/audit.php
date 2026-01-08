<?php
namespace App\Helpers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

if (!function_exists('auditLog')) {
    function auditLog($action, $summary, $subject = null)
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'summary' => $summary,
            'subject_type' => $subject ? class_basename($subject) : null,
            'subject_id' => $subject?->id,
            'ip_address' => request()->ip(),
        ]);
    }
}

