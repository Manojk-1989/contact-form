    <?php

    use Illuminate\Support\Facades\Route;
    use ContactForm\Http\Controllers\AdminController;
    use App\Http\Middleware\AdminMiddleware;

    // Admin web routes
    Route::middleware([AdminMiddleware::class])->prefix('admin')->group(function () {
        Route::get('/contact-submissions', [AdminController::class, 'index']);
    });
