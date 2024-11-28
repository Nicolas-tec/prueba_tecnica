<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libros;
use Illuminate\Http\JsonResponse;
use App\Models\prestamos;
use App\Models\User;
use App\Models\categoria;

class StatsController extends Controller
{
    public function mostBorrowedBooks(): JsonResponse{
        $libros = libros::withCount('prestamos')
        ->ordenBy('loans_count', 'desc')
        ->limit(10)
        ->get();
        return response()->json(['data' => $libros]);
    }
    public function mostActiveUsers(): JsonResponse{
        $users = User::withCount('prestamos')
        ->orderBy('loans_count', 'desc')
        ->limit(10)
        ->get();
        return response()->json(['data' => $users]);
    }
    public function mostAvailableBooks(): JsonResponse{
        $libros = libros::oederBy('quantity', 'desc')
        ->limit(10)
        ->get();
        return response()->json(['data' => $libros]);
    }
    public function loansPerMonth(): JsonResponse{
        $prestamos = prestamos::selectRaw('MONTH(borrowed_at) as month, COUNT(*) as total_loans')
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        return response()->json(['data' => $prestamos]);
    }
    public function mostPopularCategories(): JsonResponse{
        $categorias = categoria::withCount('prestamos')
        ->orderBy('loans_count', 'desc')
        ->limit(10)
        ->get();
        return response()->json(['data' => $categorias]);
    }
}
