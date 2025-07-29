<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth Routes
use App\Http\Livewire\Auth\Login as Login;
use App\Http\Controllers\AuthController as Auth;
use App\Http\Controllers\ExportsController;
use App\Http\Controllers\ImportsController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\SandboxController;
use App\Http\Controllers\SmsController;
use App\Http\Livewire\Auth\Index as Register;
use App\Http\Livewire\Auth\Show as Profile;
use App\Http\Livewire\DocumentTypes\Index as DocumentTypes;
use App\Http\Livewire\HelpGuide\Index as HelpGuideIndex;
use App\Http\Livewire\HelpGuide\Show as HelpGuideShow;
use App\Http\Livewire\Roles\Index as RoleIndex;
use App\Http\Livewire\Roles\Show as RoleShow;
use App\Http\Livewire\Permissions\Index as Permissions;
use App\Http\Livewire\Dashboard\Index as DashboardIndex;
use App\Http\Livewire\User\Show as UserShow;
use App\Http\Livewire\User\Profile as UserProfile;
use App\Http\Controllers\PrintController as PrintController;
use App\Http\Livewire\ActivityLogs\Index as ActivityIndex;
use App\Http\Livewire\ActivityLogs\Show as ActivityShow;
use App\Http\Livewire\DocumentCustody\Index as CustodyIndex;
use App\Http\Livewire\Notifications\Index as NotificationsIndex;
use App\Http\Livewire\ControlPanel\Index as CtrlIndex;
use App\Http\Livewire\ControlPanel\History as CtrlHistory;
use App\Http\Livewire\BulkMessages\Index as BulkMessagesIndex;
use App\Http\Livewire\MonitorJobs\Index as JobsIndex;
use App\Http\Livewire\MonitorJobs\Show as JobsShow;
use App\Http\Livewire\MonitorJobs\Failed as JobsFailed;

// Only routes that match the above use clauses are kept

// Guest Only
Route::group(['middleware' => ['guest']], function() {
    Route::middleware(['throttle:three-per-minute'])
    ->get('/login', Login::class)
    ->name('login');
});

// Auth Only
Route::group(['middleware' => ['auth']], function() {

    // Dashboard
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');
    Route::get('/', DashboardIndex::class)->name('home');
    Route::get('/home', DashboardIndex::class);

    // Jobs Monitoring
    Route::get('/jobs/show/{job}', JobsShow::class)->name('jobs.show');
    Route::get('/jobs/index', JobsIndex::class)->name('jobs.index');
    Route::get('/jobs/failed', JobsFailed::class)->name('jobs.failed');

    // Auth & Profile
    Route::get('/register', Register::class)->name('register');
    Route::get('/logout', [Auth::class,'signOut'])->name('logout');
    Route::get('/profile', Profile::class)->name('profile');

    // Roles & Permissions
    Route::get('/roles', RoleIndex::class)->name('role.index');
    Route::get('/roles/{role}', RoleShow::class)->name('role.show');
    Route::get('/permissions', Permissions::class)->name('permissions');

    // Document Types
    Route::get('/document-types', DocumentTypes::class)->name('document-types.index');
    Route::post('/document-types', DocumentTypes::class)->name('document-types.store');
    Route::put('/document-types', DocumentTypes::class)->name('document-types.delete');

    // Help Guide
    Route::get('/help-guide/{article}', HelpGuideShow::class)->name('help-guide.show');
    Route::get('/help-guide', HelpGuideIndex::class)->name('help-guide.index');
    Route::post('/help-guide', HelpGuideIndex::class)->name('help-guide.store');
    Route::put('/help-guide', HelpGuideIndex::class)->name('help-guide.delete');

    // User Management
    Route::get('/users', UserShow::class)->name('users');
    Route::post('/users', UserShow::class)->name('users.store');
    Route::put('/users', UserShow::class)->name('users.delete');
    Route::get('/users/{user}', UserProfile::class)->name('users.profile');

    // Activity Logs
    Route::get('/activity/{activity}', ActivityShow::class)->name('activity.show');
    Route::get('/activity', ActivityIndex::class)->name('activity.index');

    // Notifications
    Route::get('/notifications', NotificationsIndex::class)->name('notifications');

    // Control Panel
    Route::get('/control-panel/index', CtrlIndex::class)->name('control-panel.index');
    Route::get('/control-panel/history', CtrlHistory::class)->name('control-panel.history');

    // Bulk Messages
    Route::get('/bulk-messages', BulkMessagesIndex::class)->name('bulk-messages.index');
    Route::post('/bulk-messages', BulkMessagesIndex::class)->name('bulk-messages.store');
    Route::put('/bulk-messages', BulkMessagesIndex::class)->name('bulk-messages.delete');

    // Document Custody
    Route::get('/documents/custody', CustodyIndex::class)->name('documents-custody.index');
    Route::put('/documents/custody', CustodyIndex::class)->name('documents-custody.delete');

    // Printing
    Route::get('print/audit-log',[PrintController::class,'printAuditLog'])->name('audit.general.print');
    Route::get('print/user/audit-log/{user}',[PrintController::class,'printAuditLog'])->name('audit.user.print');

    // DocumentsController routes
    Route::get('/documents/download/{document}', [DocumentsController::class,'downloadDocument'])->name('documents.download');
    Route::get('/documents/delete/{document}', [DocumentsController::class,'deleteDocument'])->name('documents.delete');
    Route::post('/documents/custody/store', [DocumentsController::class,'storeEmployeeDocument'])->name('documents-custody.store');

    // ExportsController routes
    Route::get('export/users', [ExportsController::class, 'exportUsers'])->name('export.users');

    // ImportsController routes
    Route::post('import/users',[ImportsController::class, 'importUsers'])->name('import.users');

    // Sandbox
    Route::get('/design/sandbox', [SandboxController::class,'index'])->name('design.sandbox');

    // SMS
    Route::get('/sms/sandbox', [SmsController::class,'sendMessage'])->name('sms.sandbox');
});
