<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of all subscribers.
     */
    public function index(Request $request)
    {
        $query = Subscriber::whereNotNull('email_verified_at');

        // Handle search functionality
        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        $subscribers = $query->latest()->paginate(20);

        return view('admin.subscribers.index', compact('subscribers'));
    }

    /**
     * Remove the specified subscriber from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('success', 'Subscriber deleted successfully.');
    }
    
    /**
     * Export all subscribers to a CSV file.
     */
    public function export()
    {
        $subscribers = Subscriber::whereNotNull('email_verified_at')->get();
        $fileName = 'subscribers_' . date('Y-m-d') . '.csv';
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($subscribers) {
            $file = fopen('php://output', 'w');
            // Add CSV headers
            fputcsv($file, ['Email', 'Subscribed At']);

            // Add data row by row
            foreach ($subscribers as $subscriber) {
                fputcsv($file, [$subscriber->email, $subscriber->email_verified_at]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}