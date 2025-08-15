<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sales;
use App\Models\Order;
use App\Models\InventoryAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getStats()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        
        // Today's sales
        $todaySales = Sales::whereDate('created_at', $today)->sum('total_amount');
        $yesterdaySales = Sales::whereDate('created_at', $yesterday)->sum('total_amount');
        
        // Today's refunds
        $todayRefunds = Sales::whereDate('created_at', $today)
            ->where('status', 'refunded')
            ->sum('total_amount');
        
        // Net sales
        $todayNet = $todaySales - $todayRefunds;
        
        // Sales target progress (assuming daily target of 10000)
        $dailyTarget = 10000;
        $targetProgress = $dailyTarget > 0 ? ($todayNet / $dailyTarget) * 100 : 0;
        
        // Products in stock
        $productsInStock = Product::where('stock_quantity', '>', 0)->count();
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 'active')->count();
        
        // Low stock items
        $lowStockItems = Product::where('stock_quantity', '<=', DB::raw('low_stock_threshold'))
            ->where('stock_quantity', '>', 0)
            ->count();
        
        // Expiring soon items (within 30 days)
        $expiringSoon = Product::where('expiry_date', '<=', Carbon::now()->addDays(30))
            ->where('expiry_date', '>', Carbon::now())
            ->where('stock_quantity', '>', 0)
            ->count();
        
        // Recent orders
        $recentOrders = Order::with(['customer', 'items.product'])
            ->latest()
            ->take(5)
            ->get();
        
        // Popular products
        $popularProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->take(10)
            ->get();
        
        return response()->json([
            'today_sales' => $todaySales,
            'today_refunds' => $todayRefunds,
            'today_net' => $todayNet,
            'target_progress' => $targetProgress,
            'products_in_stock' => $productsInStock,
            'total_products' => $totalProducts,
            'active_products' => $activeProducts,
            'low_stock_count' => $lowStockItems,
            'expiring_count' => $expiringSoon,
            'recent_orders' => $recentOrders,
            'popular_products' => $popularProducts
        ]);
    }
    
    public function getChartData($period = 'daily')
    {
        $data = [];
        $labels = [];
        
        switch ($period) {
            case 'daily':
                $data = $this->getDailyChartData();
                break;
            case 'weekly':
                $data = $this->getWeeklyChartData();
                break;
            case 'monthly':
                $data = $this->getMonthlyChartData();
                break;
        }
        
        return response()->json($data);
    }
    
    private function getDailyChartData()
    {
        $days = 7;
        $data = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $sales = Sales::whereDate('created_at', $date)->sum('total_amount');
            $refunds = Sales::whereDate('created_at', $date)
                ->where('status', 'refunded')
                ->sum('total_amount');
            
            $data[] = [
                'date' => $date->format('M d'),
                'sales' => $sales,
                'refunds' => $refunds,
                'net' => $sales - $refunds
            ];
        }
        
        return $data;
    }
    
    private function getWeeklyChartData()
    {
        $weeks = 8;
        $data = [];
        
        for ($i = $weeks - 1; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            
            $sales = Sales::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');
            $refunds = Sales::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->where('status', 'refunded')
                ->sum('total_amount');
            
            $data[] = [
                'week' => 'Week ' . $startOfWeek->format('M d'),
                'sales' => $sales,
                'refunds' => $refunds,
                'net' => $sales - $refunds
            ];
        }
        
        return $data;
    }
    
    private function getMonthlyChartData()
    {
        $months = 6;
        $data = [];
        
        for ($i = $months - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $sales = Sales::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total_amount');
            $refunds = Sales::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'refunded')
                ->sum('total_amount');
            
            $data[] = [
                'month' => $date->format('M Y'),
                'sales' => $sales,
                'refunds' => $refunds,
                'net' => $sales - $refunds
            ];
        }
        
        return $data;
    }
}
