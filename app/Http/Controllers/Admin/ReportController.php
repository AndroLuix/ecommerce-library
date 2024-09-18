<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {

        /* 
        $books = Book::withCount([
            'order as sales_count' => function($q) {

                
                $q->whereHas('payment', function($qy){
                    $qy->where('confirmed', 1);
                });
            }
        ])
        ->orderBy('sales_count','DESC')
        ->get(); 
        */


        $books = DB::select(
            "SELECT b.*, SUM(o.quantity) AS sales_count
            FROM books b
            JOIN orders o ON o.book_id = b.id
            JOIN order_payments op ON op.order_id = o.id
            WHERE op.confirmed = TRUE
            GROUP BY b.id
            ORDER BY sales_count DESC;
            
            "
        );


        // dd($books);

        return view('admin.report.report', compact('books'));
    }
}
