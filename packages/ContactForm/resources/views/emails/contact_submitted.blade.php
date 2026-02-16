<h2>New Contact Form Submission</h2>

<p><strong>Name:</strong> {{ $submission->name }}</p>
<p><strong>Email:</strong> {{ $submission->email }}</p>
<p><strong>Subject:</strong> {{ $submission->subject }}</p>
<p><strong>Message:</strong></p>
<p>{{ $submission->message }}</p>
<p><strong>Submitted At:</strong> {{ $submission->created_at }}</p>
