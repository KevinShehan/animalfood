<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AuditLogController extends Controller
{
    /**
     * Display a listing of audit logs
     */
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->orderBy('created_at', 'desc');

        // Filtering
        if ($request->filled('action')) {
            $query->byAction($request->action);
        }

        if ($request->filled('model_type')) {
            $query->byModel($request->model_type);
        }

        if ($request->filled('user_id')) {
            $query->byUser($request->user_id);
        }

        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', Carbon::parse($request->date_from)->startOfDay());
        }

        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', Carbon::parse($request->date_to)->endOfDay());
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('model_type', 'like', "%{$search}%")
                  ->orWhere('user_name', 'like', "%{$search}%")
                  ->orWhereRaw('JSON_SEARCH(old_values, "one", ?) IS NOT NULL', ["%{$search}%"])
                  ->orWhereRaw('JSON_SEARCH(new_values, "one", ?) IS NOT NULL', ["%{$search}%"]);
            });
        }

        $auditLogs = $query->paginate(20);

        // Get filter options
        $actions = AuditLog::distinct()->pluck('action')->filter()->sort();
        $modelTypes = AuditLog::distinct()->pluck('model_type')->filter()->sort()->map(function($type) {
            return [
                'value' => $type,
                'label' => class_basename($type)
            ];
        });
        $users = User::orderBy('name')->get(['id', 'name']);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.audit-logs.table', compact('auditLogs'))->render(),
                'pagination' => $auditLogs->links()->render()
            ]);
        }

        return view('admin.audit-logs.index', compact('auditLogs', 'actions', 'modelTypes', 'users'));
    }

    /**
     * Show detailed audit log
     */
    public function show(AuditLog $auditLog)
    {
        $auditLog->load('user');
        return response()->json($auditLog);
    }

    /**
     * Export audit logs
     */
    public function export(Request $request)
    {
        $query = AuditLog::with('user');

        // Apply same filters as index
        if ($request->filled('action')) {
            $query->byAction($request->action);
        }

        if ($request->filled('model_type')) {
            $query->byModel($request->model_type);
        }

        if ($request->filled('user_id')) {
            $query->byUser($request->user_id);
        }

        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', Carbon::parse($request->date_from)->startOfDay());
        }

        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', Carbon::parse($request->date_to)->endOfDay());
        }

        $auditLogs = $query->orderBy('created_at', 'desc')->get();

        $filename = 'audit_logs_' . now()->format('Y_m_d_H_i_s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($auditLogs) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID',
                'Date/Time',
                'Action',
                'Model Type',
                'Model ID',
                'User',
                'Description',
                'Changes',
                'IP Address'
            ]);

            foreach ($auditLogs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->created_at->format('Y-m-d H:i:s'),
                    $log->formatted_action,
                    $log->model_name,
                    $log->model_id,
                    $log->user_name,
                    $log->description,
                    $log->formatted_changes,
                    $log->ip_address
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get audit statistics
     */
    public function getStats()
    {
        $stats = [
            'total_logs' => AuditLog::count(),
            'today_logs' => AuditLog::whereDate('created_at', today())->count(),
            'this_week_logs' => AuditLog::whereBetween('created_at', [
                now()->startOfWeek(), 
                now()->endOfWeek()
            ])->count(),
            'this_month_logs' => AuditLog::whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)->count(),
            
            'actions_stats' => AuditLog::selectRaw('action, COUNT(*) as count')
                                     ->groupBy('action')
                                     ->pluck('count', 'action'),
            
            'models_stats' => AuditLog::selectRaw('model_type, COUNT(*) as count')
                                    ->groupBy('model_type')
                                    ->pluck('count', 'model_type')
                                    ->map(function($count, $type) {
                                        return [
                                            'model' => class_basename($type),
                                            'count' => $count
                                        ];
                                    }),
            
            'users_stats' => AuditLog::selectRaw('user_name, COUNT(*) as count')
                                   ->whereNotNull('user_name')
                                   ->groupBy('user_name')
                                   ->orderByDesc('count')
                                   ->limit(10)
                                   ->pluck('count', 'user_name')
        ];

        return response()->json($stats);
    }

    /**
     * Clean old audit logs
     */
    public function cleanup(Request $request)
    {
        $request->validate([
            'days' => 'required|integer|min:30|max:3650'
        ]);

        $cutoffDate = now()->subDays($request->days);
        $deletedCount = AuditLog::where('created_at', '<', $cutoffDate)->delete();

        return response()->json([
            'success' => true,
            'message' => "Successfully deleted {$deletedCount} audit log records older than {$request->days} days.",
            'deleted_count' => $deletedCount
        ]);
    }
}