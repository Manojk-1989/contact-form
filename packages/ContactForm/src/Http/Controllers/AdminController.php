<?php

namespace ContactForm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ContactForm\Models\ContactSubmission;

class AdminController extends Controller
{
    // Admin dashboard: list all submissions
    public function index(Request $request)
    {
        $query = ContactSubmission::with('user');

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $submissions = $query->paginate(10);

        // For simplicity, return JSON for now
        // You can replace with a blade view later
        return response()->json($submissions);
    }
}
