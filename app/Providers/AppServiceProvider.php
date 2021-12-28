<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\giohang;
use App\Models\danhmuc;
use App\Models\sanpham;
use App\Models\nhanvien;
use App\Models\khachhang;
use App\Models\dathang;
use App\Models\khuyenmai;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('*',function($view){
            $view->with([
                'danhmuc'=>danhmuc::all(),
                'khuyenmai'=>khuyenmai::all(),
                'giohang'=>new giohang(),
                'sp'=>sanpham::search()->paginate(12)
            ]);

            $sanpham= sanpham::all()->count();
            $nhanvien= nhanvien::all()->count();
            $khachhang= khachhang::all()->count();
            $dh= dathang::all()->count();
            $view->with('sanpham',$sanpham)->with('nhanvien',$nhanvien)->with('khachhang',$khachhang)->with('dh',$dh);

        });
    }
}
