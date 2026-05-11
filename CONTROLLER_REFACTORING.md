# Controller Refactoring Guide

## AdminController (Lightweight - Only Dashboard)
**Functions:** 
- `dashboard()` - Main admin dashboard with student and teacher data

---

## AuthController (Authentication)
**Functions:**
- `register()` - Show registration form
- `storeUser()` - Store new user
- `login()` - Show login form
- `loginUser()` - Handle login
- `logout()` - Handle logout

---

## ProfileController (User Profile Management)
**Functions:**
- `editProfile()` - Show edit profile form
- `updateProfile()` - Update user profile and image
- `showPicProfile()` - Show profile picture page
- `show()` - Show user details

---

## UserManagementController (Roles & Permissions)
**Functions:**
- `admins()` - List all admins
- `roles()` - Manage user roles
- `updateUserRole()` - Update user role
- `permissions()` - View permissions by role

---

## SettingsController (School Settings)
**Functions:**
- `index()` - Show settings form
- `update()` - Update school settings and logo

---

## AttendanceController (Attendance)
**Functions:**
- `mark()` - Mark attendance form
- `store()` - Store attendance record

---

## ExamController (Exam Management)
**Functions:**
- `create()` - Create exam form
- `store()` - Store exam

---

## Routes Reference

Update your `routes/web.php` accordingly:

```php
// Auth Routes
Route::post('/register', [AuthController::class, 'storeUser'])->name('register.store');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Profile Routes
Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('admin.profile.update');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

// User Management Routes
Route::get('/admins', [UserManagementController::class, 'admins'])->name('admin.admins');
Route::get('/roles', [UserManagementController::class, 'roles'])->name('admin.roles.index');
Route::post('/roles/{id}', [UserManagementController::class, 'updateUserRole'])->name('admin.roles.update');
Route::get('/permissions', [UserManagementController::class, 'permissions'])->name('admin.permissions');

// Settings Routes
Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
Route::post('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');

// Attendance Routes
Route::get('/attendance/mark', [AttendanceController::class, 'mark'])->name('admin.attendance.mark');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('admin.attendance.store');

// Exam Routes
Route::get('/exams/create', [ExamController::class, 'create'])->name('admin.exams.create');
Route::post('/exams', [ExamController::class, 'store'])->name('admin.exams.store');
```

---

## Benefits of This Refactoring

✅ **Separation of Concerns** - Each controller has a single responsibility
✅ **Easy Maintenance** - Find related functions in one place
✅ **Scalability** - Easy to add new features without bloating controllers
✅ **Reusability** - Controllers can be used by multiple routes
✅ **Testing** - Easier to write unit tests for smaller controllers
✅ **Code Organization** - Clear structure and hierarchy
