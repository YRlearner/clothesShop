<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin')->except(["showAdminLoginForm", "adminLogin"]);
    }

    public function index(){
        return view('admin.index')->with([
            "products" => Product::all(),
            "orders" => Order::all()
            ]);
    }

    public function showAdminLoginForm(){
        if(auth()->guard('admin')->check()){
            return redirect('/admin');
        }
        return view('admin.auth.login');
    }

    public function adminLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return redirect('admin/login')->withErrors($validator)->withInput();
        }
       

        if(auth()->guard("admin")->attempt(['email' => $request->email, 
            'password' => $request->password],
            $request->get('remember'))){
            return redirect('/admin');
            } else {
            return redirect()->route('admin.login')->with(['errorLink' =>'Invalid email or password']);
        }
    }
    public function adminLogout(){
        auth()->guard("admin")->logout();
        return redirect('admin/login');
    }
    public function getProducts()
    {
        return view("admin.products.index")->with([
            "products" => Product::latest()->paginate(5)
        ]);
    }

    public function getOrders()
    {
        return view("admin.orders.index")->with([
            "orders" => Order::latest()->paginate(5)
        ]);
    }
    

    
}
