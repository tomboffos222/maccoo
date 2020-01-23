<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\User;
use Illuminate\Http\Request;
use App\BlackListed;
use App\Authors;
use App\Product;
use App\Categories;

class UserController extends Controller
{

    public function Home(){

        $data['products'] = Product::orderBy('id','desc')->paginate(12);
        $data['authors'] = Authors::paginate(12);
        $data['categories'] = Categories::paginate(20);
        $data['sliders'] = Product::orderBy('id','desc')->paginate(3);



        return view('home',$data);
    }
    public function Shop(){
        $data['products'] = Product::paginate(12);
        $data['authors'] = Authors::get();
        $data['categories'] = Categories::get();



        return view('shop',$data);
    }
    public function Search(Request $request){

        $rules = [
            'category' =>'required|max:255',
            'author' =>'required|max:255'

        ];

        $messages = [
            "category.required" => "Выберите категорию",
            "author.required" => "Выберите автора"
        ];
        $validator = $this->validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());

        }else{
            if ($request['category'] == 'All') {
                $data['products'] = Product::paginate(12);
                $data['authors'] = Authors::get();
                $data['categories'] = Categories::get();
                if($request['author'] != 'All'){
                
                $data['products'] =Product::where('author','LIKE','%'.$request['author'].'%')->paginate(12);
                $data['authors'] = Authors::get();
                $data['categories'] = Categories::get();
                
                }
                
                # code...
            }elseif ($request['category'] != 'All') {
                
                $data['products'] =Product::where('chars','LIKE','%'.$request['category'].'%')->paginate(12);
                $data['authors'] = Authors::get();
                $data['categories'] = Categories::get();
                if($request['author'] != 'All'){
                
                $data['products'] =Product::where('author','LIKE','%'.$request['author'].'%');
                $data['products']  = $data['products']->where('chars','LIKE','%'.$request['category'].'%')->paginate(12);

                $data['authors'] = Authors::get();
                $data['categories'] = Categories::get();
                
                }
                
                # code...
            }
            return view('shop',$data);

            
        }

        
    }
    public function Product($productId){
        $products = Product::where('id','!=',$productId)->get();
        $product = Product::find($productId);


        return view('product',['products'=>$products,'product'=>$product]);
    }
    public function RegisterPage(){
        return view('register');
    }
    public function Category($categoryId){
        $data['categories'] = Categories::get();
        $data['authors'] = Authors::get();
        $category = Categories::find($categoryId);
        $data['products'] = Product::where('chars' , 'LIKE', '%'.$category['chars'].'%')->paginate(12);



        return view ('shop',$data);

    }
    public function Authors(){

        $data['authors'] = Authors::paginate(10);
        return view('authors',$data);
    }
    public function Author($authorId){
        $author = Authors::find($authorId);

        $products = Product::where('author','LIKE','%'.$author['Name'].'%')->paginate(10);


        return view('author',['author'=>$author , 'products' => $products]);
    }
    public function Register(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'login' => 'required|numeric|unique:users,login',
            'bs_id' => 'required|numeric|unique:users,bs_id',
            'phone' => 'required',
            'email' => 'required|email'
        ];

        $messages = [
            "name.required" => "Введите ваше имя",
            "login.required" => "Введите ваш Логин",
            "login.unique" => "Логин занять,введите другой логин",
            "phone.required" => "Введите телефон номер",
            
            "bs_id.unique" => "ID уже занято"
        ];

        $validator = $this->validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());

        } else {
            User::create($request->only(['bs_id','login','email','name','phone']));
            return redirect()->route('Main')->with('message','Ваш запрос отправлен!');
        }
    }

    public function LoginPage(){
        return view('login');
    }

    public function Login(Request $request)
    {
        $rules = [
            'login' => 'required|max:255|exists:users,login',
            'password' => 'required|max:255',
        ];

        $messages = [
            "login.exists" => "Неверный логин",
        ];

        $validator = $this->validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());

        } else {
            $user = User::whereLogin($request['login'])->wherePassword($request['password'])->where('status',['partner','registered'])->first();

            if (!$user){
                return redirect()->route('LoginPage')->withErrors('Логин или пароль не верно');
            }
            session()->put('user',$user);
            session()->save();

            return redirect()->route('Home');
        }
    }
    public function Edit(){
        $user= session()->get('user');

        $data['user'] = User::find($user['id']);

        return view('edit', $data);
    }
    public function EditUser(Request $request){
        $data['user'] = session()->get('user');
        $rules = [
            'id'=>'required|max:255',
            'email' => 'required|max:255',
            'name' => 'required|max:255',
            'phone'  => 'required|max:14',
            'password' => 'required|max:14'

        ];
        $messages = [
            "id.required"=>"Введите id",
            "email.required" => "Введите email",
            "name.required" => "Введите ФИО",
            "phone.required" => "Введите телефон",
            "password.required" => "Введите пароль"
        ];
        $validator = $this->validator($request->all(), $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            
            (new \App\Models\User)::where('id',$data['user']->id)->update($request->only(['password','email','name','phone']));
            
            



            return back()->with('message','Изменено');


        }
        


    }
    public function Out(Request $request){
        session()->forget('user');
        return redirect()->route('LoginPage')->withErrors('Вы вышли');
    }

    public function Main(){
        $data['user'] = session()->get('user');


        $data['tree'] = Tree::whereUserId($data['user']->id)->first();

        return view('main',$data);
    }

    public function Tree($userId = null){
        $user = Tree::join('users','users.id','tree.user_id')
            ->select('tree.*','name','phone','login','bs_id','email');
        if ($userId){
            $user = $user->find($userId);
        }else{
            $user = $user->first();
        }
        return view('tree',['user'=>$user]);
    }

}
