<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\User;
use Illuminate\Http\Request;
use App\BlackListed;
use App\Authors;
use App\Product;
use App\Categories;
use App\Withdrawal;
use App\Message;
class UserController extends Controller

{
    public function addProduct($id){

        $id = intval($id);

        $productsInCart =  array();




        $counter  = session()->get('cart');


        if (!empty($counter)) {

            $counter =  session()->get('cart');
            $productsInCart[$id] = 1;


            if(array_key_exists($id, $counter)){
                    $counter[$id]++;

            }else{
                    $newId = key($productsInCart);
                    $counter[$newId] = 1;

            }

            session()->put('cart',$counter);
            session()->save();

        }else{
            $productsInCart[$id] = 1;
            session()->put('cart', $productsInCart);

            session()->save();
        }
        $counter = session()->get('cart');
        if(!empty($counter)){
            $count = 0;

            foreach($counter  as $id => $quantity){
                $count  = $count + $quantity;


            }
            session()->put('count', $count);
            session()->save();

        }


        return back()->with('message','Добавлено в корзину');


    }
    public function SearchForm(Request $request){
        $rules = [
            'name' => 'required|max:255'
        ];
        $messages = [
            "name.required" => "Введите название книги или имя автора",
            "name.max"=>"Максимальное количество символов 255"
        ];
        $validator = $this->validator($request->all(),$rules, $messages);

        if ($validator->fails()){
            return back()->withErrors($validator->errors());



        }else{
            $data['products'] = Product::where('title', 'LIKE', '%'.$request['name'].'%')->orWhere('author','LIKE','%'.$request['name'].'%')->paginate(12);
            $data['authors'] = Authors::get();
            $data['categories'] = Categories::get();
            return view('shop',$data);
        }
    }
    public function DeleteProduct($id){
        $id = intval($id);
        $cart = session()->get('cart');

        unset($cart[$id]);
        session()->put('cart',$cart);
        session()->save();
        $new = session()->get('cart');


        if(!empty($new)){
            $count = 0;

            foreach($new  as $id => $quantity){
                $count  = $count + $quantity;


            }

            session()->put('count', $count);


            session()->save();



        }else{
            $count = 0;
            session()->put('count', $count);
            session()->save();
        }

        return back()->with('message','Удалено с корзины');

    }
    public function WithdrawShow(){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        $data['withdraws'] = Withdrawal::join('users', 'withdrawals.user_id', '=', 'users.id')->paginate(12);


        $user = User::find($user['id']);



        return view('withdraw',$data);

    }
    public function WithdrawCreate(Request $request){
        $rules = [
            'amount' => 'required|max:1000000'
        ];
        $messages = [
            "amount.required" => "Введите сумму для вывода средств",
            "amount.max"  => "Максимальное количество средств для вывода 999999"
        ];
        $validator = $this->validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());

        }else{
            $user = session()->get('user');
            $user = User::find($user['id']);

            $summary = $user['bill'] - $request['amount'];
            if ($summary < 0) {

                return back()->withErrors('Недостаточно средств');

                # code...
            }else{
                $withdraw = new Withdrawal;
                $withdraw['amount'] = $request['amount'];
                $withdraw['user_id'] = $request['user_id'];
                $withdraw['withdraw_status'] = 'sent';

                $withdraw->save();


                $user['bill'] = $summary;

                $user->save();

                return back()->with('message', 'Ваша заявка отправлена');

            }
        }
    }
    public function DeleteAll(){

        $counter = session()->get('cart');
        $counter = array();
        if (empty($counter)) {
            session()->put('cart',$counter);

            $count = 0;
            session()->put('count', $count);
            session()->save();
            # code...
        }
        return redirect()->route('Home')->with('message','Все удалено с корзины');
    }
    public function CartPage(){
        $cartItems = session()->get('cart');
        $cartItems = array_keys($cartItems);



        $data['products'] = Product::whereIn('id', $cartItems)->paginate(12);
        $products = Product::whereIn('id', $cartItems)->get();


        $cartSession = session()->get('cart');
        $subTotal = 0;
        foreach ($products as $product) {



                $cartSession[$product['id']] = intval($cartSession[$product['id']]);
                $product['price'] = intval($product['price']);

                $subTotal += $cartSession[$product['id']] * $product['price'];






            # code...


        }

            session()->put('subTotals', $subTotal);
            session()->save();



            # code...







        return view('cart', $data);


    }



    public function Up(){
        $user= session()->get('user');

        $data['user'] = User::find($user['id']);
        return view('up',$data);
    }
    public function AccountUp(){
        $user= session()->get('user');

        $user = User::find($user['id']);

        $user['bill'] = $user['bill'] - 20000;

        if ($user['bill'] < 0 ) {

            return back()->withErrors('Недостаточно средств');
            # code...
        }else{
            $user['status'] = 'partner';

            $user->save();

            return back()->with('message','Оплачено, ваш статус: партнер');


        }


    }
    public function Home(){

        $data['products'] = Product::orderBy('id','desc')->paginate(12);
        $data['authors'] = Authors::paginate(12);
        $data['categories'] = Categories::paginate(20);
        $data['sliders'] = Product::orderBy('id','desc')->paginate(3);




        return view('home',$data);
    }
    public function Shop(){
        $data['products'] = Product::orderBy('id')->paginate(7);
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

            'password' =>'required|max:255',
            'phone' => 'required',
            'email' => 'required|email',
            'zhsn' => 'required|max:14'
        ];

        $messages = [

            "name.required" => "Введите ваше имя",
            "password.required" =>"Введите пароль",
            "login.unique" => "Логин занять,введите другой логин",
            "phone.required" => "Введите телефон номер",
            "zhsn.required" =>"Введите ИИН",
            "zhsn.max" => "Максимальное количество 14"
        ];

        $validator = $this->validator($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());

        } else {
            $lastuser = User::orderBy('id','desc')->first();

            $user = new User;


            $user['login'] = 000000+$lastuser['id']+1;
            $user['password'] = $request['password'];

            $user['zhsn'] = $request['zhsn'];
            $user['phone'] = $request['phone'];
            $user['email'] = $request['email'];
            $user['status'] = 'registered';
            $user['name']  =$request['name'];
            $user['bill'] = 0;
            $user->save();
            return redirect()->route('Home')->with('message','Ваш запрос отправлен! Ваш логин:'.$user['login']);
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
            $user = User::whereLogin($request['login'])->wherePassword($request['password'])->whereIn('status',['registered','partner'])->first();

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
    public function Account(){
        $data['user'] = session()->get('user');

        return view('account',$data);
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
            if($request['zhsn'] == 0){
            (new \App\Models\User)::where('id',$data['user']->id)->update($request->only(['password','email','name','phone']));
            }else{
            (new \App\Models\User)::where('id',$data['user']->id)->update($request->only(['password','zhsn','email','name','phone']));
            }




            return back()->with('message','Изменено');


        }



    }
    public function MessageSend(Request $request){
        $rules = [
            'question'  => 'required|max:255',
            'author' => 'required|max:255'

        ];
        $messages = [
            "question.required" => "Введите ваш вопрос",
            "author.required" => "Введите ваш аккаунт",
            "question.max" =>"Максимальное количество символов 255"
        ];
        $validator = $this->validator($request->all(), $rules, $messages);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{

            $message = new Message;
            $message['question'] = $request['question'];

            $message['author'] =$request['author'];


            $message->save();

            return back()->with('message','Отправлено');


        }


    }
    public function MessagePage(){

        $data['user'] = session()->get('user');
        $user = $data['user'];

        $data['messages'] = Message::where('author',$user['login'])->where('answer','!=',NULL)->paginate(3);
        return view('message',$data);
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
            ->select('tree.*','name','phone','login','email');
        if ($userId){
            $user = $user->find($userId);
        }else{
            $user = $user->first();
        }
        return view('tree',['user'=>$user]);
    }

}
