<?php

use App\Models\User;
use App\Models\Jabatans;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAdmin;
use App\Models\Jobdesk;
use App\Models\Post;
use PhpParser\Node\Scalar\MagicConst\Function_;
use PHPUnit\TextUI\Configuration\Group;


Route::get('/', function () {
    $posts = Post::latest();
    return view('index',['tittle' => 'Dashboard','posts'=>$posts]);
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login',[DashboardAdmin::class,'login']);
Route::get('/dashboard', function () {
    return view('dashboard.welcome',['tittle' => 'Dashboard']);
});
Route::get('/logout',[DashboardAdmin::class,'logout']);

Route::middleware(['auth'])->group(function(){

    
    // area admin
    Route::get('/jobdesk', function () {
        return view('dashboard.jobdesk',['tittle' => 'Job desk','karyawans'=> User::all()]);
    });

    
    ////////////////////////////  AREA ADMIN SETTING Admins     /////////////////////////////////////////////
    Route::get('/jabatans', function () {
        return view('dashboard.jabatans',['tittle' => 'Jabatan','jabatans'=> Jabatans::all()]);
    });

    Route::get('/detail-jabatan/{id}', function ($id) {
        $jabatans = Jabatans::with('jobdesks')->findOrFail($id);
        $jabatansall = Jabatans::all();
        // Mengembalikan view dengan data jabatan dan jobdesk
        return view('dashboard.jabatan', [
            'tittle' => 'Detail Jabatan',
            'jabatansall' => $jabatansall,
            'jabatans' => $jabatans,
            'jobdesks' => $jabatans->jobdesks
        ]);
    });
    Route::post('/data/{type}/{action}',[DashboardAdmin::class,'data']);
    Route::post('/data/{type}/{action}/{id}',[DashboardAdmin::class,'data']);
    Route::delete('/data/{type}/{action}/{id}',[DashboardAdmin::class,'data']);

    ////////////////////////////  AREA ADMIN SETTING Admins     /////////////////////////////////////////////
    Route::get('/admins', function () {
        $jabatans =  Jabatans::all();
        $users = User::all();
        return view('dashboard.dadmin',['tittle' => 'Admins','users'=> $users ,'jabatans'=>$jabatans ]);
    });
    Route::post('/admintambah',[DashboardAdmin::class,'tambahdata']);
    Route::post('/adminedit/{id}',[DashboardAdmin::class,'editdata']);
    Route::delete('/admindelete/{id}',[DashboardAdmin::class,'delete']);


    // area karyawan
    Route::get('/karyawans', function () {
        $karyawans = User::latest()->get();
        $jabatans =  Jabatans::all();
        return view('dashboard.karyawans',['tittle' => 'karyawans','karyawans'=> $karyawans,'jabatans'=> $jabatans]);
    });

    Route::get('/posts', function () {
        $posts = Post::latest()->get();
        return view('dashboard.posts',[
            'tittle' => 'Kelola Postingan',
            'posts'=> $posts
        ]);
    });


});


