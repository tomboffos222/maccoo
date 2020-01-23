<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Tree;

use Illuminate\Http\Request;
use App\BlackListed;
use App\Authors;
use App\Categories;
use App\Product;

class AdminController extends Controller
{
    public function LoginPage(){
        return view('admin.login');
    }
    public function Shopview(){
        $data['authors'] =  Authors::paginate(10);
        $data['categories'] = Categories::paginate(10);



        return view('admin.shop',$data);


    }
    public function Login(Request $request){
        $rules = [
            'login' => 'required|max:255',
            'password' => 'required|max:255',
        ];

        $messages = [
            "login.required" => "Введите ваш Логин",
            "password.required" => "Введите пароль",
        ];

        $validator = $this->validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());

        } else {
           $admin = Admin::whereLogin($request['login'])->wherePassword($request['password'])->first();
           if (!$admin){
               return back()->withErrors('Неверный логин или пароль');
           }
           session()->put('admin',$admin);
           session()->save();

           return redirect()->route('admin.Users');
        }
    }
    public function Out(Request $request){
        session()->forget('admin');
        return redirect()->route('admin.LoginPage')->withErrors('Вы вышли');
    }
    public function Users(Request $request){
        $data['users'] = User::whereStatus('partner')->paginate(25);
        return view('admin.users',$data);
    }
    public function CategoryAdd(Request $request){
        $rules = [
            'category' => 'required|max:255'

        ];
        $messages = [
            "category.requred"  => "Введите категорию"
        ];

        $validator  = $this->validator($request->all(), $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $category = new Categories;
            $category->chars = $request['category'];

            $category->save();

            return back()->withMessage('Добавлено');
        }
    }
    public function AuthorAdd(Request $request){
        $rules = [
            'image' => 'required|',
            'name' =>'required|max:255',
            'birth' =>'required|max:255',
            'books' => 'required',
            'address' =>'required|max:255',
            'gender' =>'required',
            'description' =>'required|max:300'
        ];
        $messages = [

            "image.required"  => "Выберите фото",
            "name.required" => "Напишите имя",
            "birth.required" =>"Введите дату рождения",
            "books.required" =>"Введите количество книг",
            "address.required" =>"Напшите адрес",
            "gender.required" =>"Выберите пол",
            "description.required" =>"Введите описание"
        ];
        $validator = $this->validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());

        } else {
            $image = $request['image'];
            
            $image = "{{asset('/uploads/image/".$image."')}}";
            
            $author = new Authors;

            $author->Name = $request['name'];
            $author->Description = $request['description'];
            $author->Address = $request['address'];
            $author->image1 = $image;
            $author->Birth = $request['birth'];
            $author->gender = $request['gender'];
            $author->Books = $request['books'];

            $author->save();



            return back()->withMessage('Добавлено');





         
            
 
        }



    }
    public function RegisterUser(Request $request){
        $rules = [
            'user_id' => 'required|exists:users,id',
            'password' => 'required|max:255',
        ];

        $messages = [
            "user_id.required" => "Введите user_id",
            "user_id.exists" => "User не найден",
            "password.required" => "Введите пароль",
        ];

        $validator = $this->validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());

        } else {
            $user = User::find($request['user_id']);
            $user->password = $request['password'];
            $user->status = 'registered';
            $user->save();

            $this->AddUserToMatrix($user->id);



            return redirect()->route('admin.Users')->withMessage('зарегистрировано!');
        }
    }
    public function ProductView(){
        $data['categories'] = Categories::get();
        $data['authors'] = Authors::get();

        $data['products'] = Product::where('status','1')->paginate(10);
        return view('admin.product',$data);
    }
    public function RejectUser($id){
        $user = User::find($id);
        $user->status = 'reject';
        $user->save();

        return redirect()->back();
    }
    public function BlackList(){
        $zhsns = BlackListed::get();
        return view('admin.blacklisted',['zhsns'=>$zhsns]);
    }
    public function AddBlackList(Request $request){
        $rules = [
            'zhsn' => 'required|max:14'
        ];
        $messages = [
            "zhsn.required" => "Введите ИИН",
            "zhsn.max"=>"Введите не больше 14 цивр"
        ];
        $validator = $this->validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());

        } else {
            $user = new BlackListed();
            $user->zhsn = $request['zhsn'];
            $user->save();

            return redirect()->route('admin.BlackList')->withMessage('Добавлено в список!');
        }

    }
    
    public function Tree($userId = null){

        $user = Tree::join('users','users.id','tree.user_id')
            ->select('tree.*','name','phone','login','bs_id','email');

        if ($userId){
           $user = $user->find($userId);
        }else{
            $user = $user->first();
        }
        return view('admin.tree',['user'=>$user]);
    }

    function AddUserToMatrix($user_id){
        if (Tree::whereUserId($user_id)->whereStatus('registered')->exists()){
            return back()->withErrors('Уже зарегистрированы');
        }

        $lastUser = Tree::orderBy('id','desc')->first();


        $neighbours =  Tree::where('parent_id',$lastUser->parent_id)->get();
        if (count($neighbours) < 2){
            $parentUser  = Tree::where('id',$lastUser->parent_id)->first();

            $new = new Tree();
            $new->user_id = $user_id;
            $new->parent_id = $lastUser->parent_id;
            $new->parents = $lastUser->parents;
            $new->row = $parentUser->row + 1;
            $new->save();

        }else{
            $parentUser = Tree::where('id',$lastUser->parent_id)->first();
            $nextUser = Tree::where('row',$parentUser->row)->where('id','>',$parentUser->id)->first();
            if ($nextUser){
                $new = new Tree();
                $new->user_id = $user_id;
                $new->parent_id = $nextUser->id;
                $new->parents = $nextUser->parents.','.$nextUser->id;
                $new->row = $nextUser->row + 1;
                $new->save();
            }else{
                $nextUser = Tree::where('row',$lastUser->row)->first();
                $new = new Tree();
                $new->user_id = $user_id;
                $new->parent_id = $nextUser->id;
                $new->parent_id = $nextUser->id;
                $new->parents = $nextUser->parents.','.$nextUser->id;
                $new->row = $nextUser->row + 1;

                $new->save();
            }
        }
    }


}
