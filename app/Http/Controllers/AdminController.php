<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Tree;
use App\OrderProduct;
use App\Orders;
use Illuminate\Http\Request;
use App\BlackListed;
use App\Authors;
use App\Categories;
use App\Withdrawal;
use App\Product;
use App\Message;

class AdminController extends Controller
{
    public function LoginPage(){
        return view('admin.login');
    }
    public function Orders(){
        $data['orders'] = Orders::paginate(12);
        return view('admin.orders',$data);
    }
    public function OrdersView($id){
        $data['order'] = Orders::find($id)->first();
        $data['products'] = Product::join('order_products','products.id','=','order_products.productId')->select('products.*','quantity','orderId')->where('orderId',$id)->paginate(12);

        return view('admin.orderview',$data);
    }
    public function Shopview(){
        $data['authors'] =  Authors::paginate(10);
        $data['categories'] = Categories::paginate(10);



        return view('admin.shop',$data);


    }
    public function WithdrawShow(){
        $data['withdraws'] = Withdrawal::join('users','users.id','=', 'withdrawals.user_id')->select('withdrawals.*','name','phone','login','email')->orderBy('created_at','desc')->paginate(12);

        return view('admin.withdraws',$data);
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
    public function WithdrawAllow($id){


        $Withdrawal = Withdrawal::find($id);


        $Withdrawal['withdraw_status'] = 'allowed';
        $Withdrawal->save();
        return back()->with('message','Одобрено');

    }
    public function WithdrawReject($id){
        $Withdrawal = Withdrawal::find($id);


        $Withdrawal['withdraw_status'] = 'rejected';
        $Withdrawal->save();
        return back()->with('message','Одобрено');
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
    public function BlackList(){
        $data['zhsns']  = BlackListed::paginate(10);
        return view('admin.blacklisted',$data);
    }
    public function MessagePage(){
        $data['messages'] = Message::where('answer',NULL)->paginate(3);
        return view('admin.message',$data);
    }
    public function MessageAnswer(Request $request){
        $rules = [
            'message_id'=>'required|max:255',
            'answer' =>'required|max:255'
        ];

        $messages = [
            "answer.required" => "Введите ответ",
            "message_id.required" =>"Введите id"
        ];

        $validator = $this->validator($request->all(), $rules , $messages);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $message = Message::find($request['message_id']);

            $message['answer'] = $request['answer'];

            $message->save();

            return back()->with('message','Отправлено!');
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
            ->select('tree.*','name','phone','login','email');

        if ($userId){
           $user = $user->find($userId);
        }else{
            $user = $user->first();
        }
        return view('admin.tree',['user'=>$user]);
    }

    function AddUserToMatrix($user_id){
        if (Tree::whereUserId($user_id)->whereStatus('partner')->exists()){
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
