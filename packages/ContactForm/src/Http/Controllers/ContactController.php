<?php

namespace ContactForm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ContactForm\Models\ContactSubmission;
use ContactForm\Mail\ContactSubmittedMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Submit contact form
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Assign authenticated user
        $data['user_id'] = auth('api')->id();

        $submission = ContactSubmission::create($data);

        // Send queued email to admin
        Mail::to(config('contactform.admin_email'))
            ->queue(new ContactSubmittedMail($submission));

        return response()->json([
            'message' => 'Form submitted successfully',
            'submission' => $submission
        ]);
    }

    // Get submissions of logged-in user
    public function mySubmissions()
    {
        $userId = auth('api')->id();

        $submissions = ContactSubmission::where('user_id', $userId)->get();

        return response()->json($submissions);
    }
}
