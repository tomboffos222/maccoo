<?php

namespace App\Http\Controllers;

use App\Article;
use App\Article_category;
use App\Basket;
use App\Models\Tree;
use App\Models\User;
use App\OrderProduct;
use App\Orders;
use Illuminate\Http\Request;
use App\BlackListed;

use App\Product;
use App\Categories;

use App\Withdrawal;
use App\Message;
use phpDocumentor\Reflection\Types\This;

class UserController extends Controller

{
    public function addProduct(Request $request){

        $rules = [
            'product_id' => 'required|max:255'
        ];
        $messages = [

            "product_id.required" => "Введите название книги или имя автора",

        ];
        $validator = $this->validator($request->all(),$rules, $messages);

        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{
            $user = session()->get('user');
            if ($user ==null){
                return back()->withErrors('Войдите в систему чтобы пользоваться корзиной');
            }else {
                $request['product_id'] = intval($request['product_id']);
                $request['user_id'] = intval($request['user_id']);
                $basket = Basket::where([
                    ['user_id', '=', $user['id']],
                    ['products', '=', $request['product_id']],
                ])->first();

                if (!$basket) {

                    $basket = new Basket;

                    $basket['quantity'] = 1;
                    $basket['user_id'] = $user['id'];
                    $basket['products'] = $request['product_id'];
                    $product = Product::find($request['product_id']);

                    $basket['total'] = $basket['quantity'] * $product['price'];
                    $basket->save();

                } else {
                    $basket['quantity'] += 1;
                    $product = Product::find($request['product_id']);
                    $basket['total'] = $basket['quantity'] * $product['price'];


                    $basket->save();


                }
                $baskets = Basket::where('user_id', $request['user_id'])->get();
                $mainCount = 0;
                foreach ($baskets as $basket) {
                    $mainCount = $mainCount + $basket['quantity'];
                }
                session()->put('count', $mainCount);
                return back()->with('message', 'Добавлено в корзину');
            }


        }









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
    public function DeleteProduct(Request $request){
        $rules = [
            'user_id' => 'required|max:255',
            'product_id' => 'required|max:255'
        ];
        $messages = [
            "user_id.required" => "Войдите чтобы добавить в корзину",
            "product_id.required" => "Введите название книги или имя автора",
            "user_id.max"=>"Максимальное количество символов 255"
        ];
        $validator = $this->validator($request->all(),$rules, $messages);

        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{
            $request['product_id'] = intval($request['product_id']);
            $request['user_id'] = intval($request['user_id']);
            $basket = Basket::where([
                ['user_id', '=', $request['user_id']],
                ['products', '=', $request['product_id']],
            ])->first();
            $basket->delete();





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
            $amount = $request['amount'];
            if ($summary < 0) {

                return back()->withErrors('Недостаточно средств');

                # code...
            }else{



                $data['withdraw'] = $amount;
                $data['summary'] = $summary;
                $data['user'] = $user;


                return view('withdrawnext',$data);

            }
        }
    }
    public function DeleteAll(){

        $user = session()->get('user');
        $basket = Basket::where('user_id',$user['id'])->delete();
        return redirect()->route('Home')->with('message','Все удалено с корзины');
    }
    public function OrderForm(Request $request){
        $user = session()->get('user');

        if($user == null) {
            return back()->withErrors('Войдите чтобы воспользоваться корзиной');
        }else {
            $rules = [

                'quantity' => 'required|max:255',
                'total' => 'required|max:255'
            ];
            $messages = [


            ];
            $validator = $this->validator($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            } else {

                $data['total'] = $request['total'];

                $data['quantity'] = $request['quantity'];
                $data['total'] = $request['total'];


            }
            return view('order', $data);
        }
    }
    public function OrderCreate(Request $request){
        $rules = [
            'index'=> 'required|max:255',
            'phone_number' => 'required|max:255',
            'address' => 'required|max:255',
            'region' => 'required|max:255',
            'city' => 'required|max:255'
        ];
        $messages = [
           "index.required" => "Введите индекс",
            "phone_number.required" => "Введите номер телефона",
            "region.required" =>"Введите регион",
            "city.required" => "Введите свой город"
        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else {


                $order = new Orders;

                $order['quantity'] = $request['quantity'];
                $order['total'] = $request['total'];
                $order['index'] = $request['index'];
                $order['phone_number'] = $request['phone_number'];
                $order['address'] = $request['address'];
                $order['region'] = $request['region'];
                $order['city'] = $request['city'];
                $order['type_of_order'] = $request['type_of_order'];

                $order->save();



                foreach ($request['products'] as $product) {
                    $product = explode(',',$product);
                    $orderProducts = new OrderProduct;
                    $orderProducts['orderId'] = $order['id'];
                    $orderProducts['productId'] = $product[0];
                    $orderProducts['quantity'] = $product[1];
                    $orderProducts->save();
                }
                return redirect()->route('shop')->with('message', 'Ваш заказ оформлен');

        }

    }
    public function CartPage(){

        $user = session()->get('user');
        $data['products'] = Product::join('baskets','products.id','=','baskets.products')->select('products.*','quantity','total','user_id')->where('user_id',$user['id'])->paginate(12);
        $products= Product::join('baskets','products.id','=','baskets.products')->where('user_id',$user['id'])->paginate(12);
        $data['quantity']  = 0;

        foreach($products as $product){
            $data['quantity']  = $data['quantity'] + $product['quantity'];
        }

        $data['total']=0;
        foreach($products as $product){
            $data['total'] = $data['total']+$product['total'];
        }





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
    public function Article($id){

        $article =Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->find($id);
        $article['views'] +=1;
        $article->save();
        $data['article'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->find($id);
        $data['NewArticles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('created_at','desc')->paginate(4);
        $data['articles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->paginate(3);
        $data['popularArticle'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->first();

        $data['cats'] = Article_category::get();
        return view('article',$data);
    }
    public function Home(){

        $data['products'] = Product::orderBy('id','desc')->paginate(12);

        $data['categories'] = Categories::paginate(20);
        $data['popularArticle'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->first();
        $data['articles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->paginate(3);
        $data['NewArticles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('created_at','desc')->paginate(4);
        $data['cats'] = Article_category::get();
        $data['sliders'] = Product::orderBy('id','desc')->paginate(3);




        return view('home',$data);
    }
    public function Shop(){
        $data['products'] = Product::orderBy('id','desc')->paginate(6);
        $data['NewArticles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('created_at','desc')->paginate(4);
        $data['categories'] = Categories::get();
        $data['cats'] = Article_category::get();



        return view('shop',$data);
    }

    public  function ArticleCategory($categoryId){
        $data['popularArticle'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->first();
        $data['cats'] = Article_category::get();
        $data['mainCat'] = Article_category::find($categoryId);
        $cat = Article_category::find($categoryId);
        $data['articles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->paginate(4);
        $data['articlesMain'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->where('cat_id',$cat['id'])->orderBy('created_at','desc')->paginate(8);
        $data['NewArticles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('created_at','desc')->paginate(4);
        return view('article_category',$data);
    }
    public  function Popular(){
        $data['popularArticle'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->first();
        $data['cats'] = Article_category::get();

        $data['articles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->paginate(4);
        $data['articlesMain'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->paginate(4);
        $data['NewArticles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('created_at','desc')->paginate(4);
        return view('article_spec',$data);
    }
    public  function FreshArticles(){
        $data['popularArticle'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->first();
        $data['cats'] = Article_category::get();

        $data['articles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('views','desc')->paginate(4);
        $data['articlesMain'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('created_at','desc')->paginate(4);
        $data['NewArticles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('created_at','desc')->paginate(4);
        return view('article_spec',$data);
    }
    public function Test(Request $request){
        $data['cats'] = Article_category::get();
        $array = array_combine($request['product_ids'],$request['quantity']);

        foreach($array as $key => $quantity){
            $product = Product::where('id',$key)->first();
            $product['new_price'] =$product['price']*$quantity;
            $product['quantity'] = $quantity;
            $new[] = $product;

        }
        $totalQuantity = 0;
        foreach($new as $product){
            $totalQuantity += $product['quantity'];
        }



        $data['products'] = $new;

        $total = 0;
        foreach($new as $product){

            $total+= $product['new_price'];
        }

        $data['NewArticles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('created_at','desc')->paginate(4);
        $data['total'] = $total;
        $data['quantity'] = $totalQuantity;


        return view('order',$data);






    }

    public  function  Search(Request $request){
        $rules = [
          'search' => 'required'
        ];
        $messages = [
          'search.required' => 'Введите название '
        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else {
            $data['popularArticle'] = Article::join('article_categories', 'articles.cat_id', '=', 'article_categories.id')->select('articles.*', 'name')->orderBy('views', 'desc')->first();
            $data['cats'] = Article_category::get();

            $data['articles'] = Article::join('article_categories', 'articles.cat_id', '=', 'article_categories.id')->select('articles.*', 'name')->orderBy('views', 'desc')->paginate(4);
            $data['articlesMain'] = Article::join('article_categories', 'articles.cat_id', '=', 'article_categories.id')->where('title','LIKE', '%' . $request['search'] . '%')->select('articles.*', 'name')->orderBy('views', 'desc')->paginate(8);


            $data['NewArticles'] = Article::join('article_categories', 'articles.cat_id', '=', 'article_categories.id')->select('articles.*', 'name')->orderBy('created_at', 'desc')->paginate(4);
            return view('article_spec', $data);
        }
    }
    public  function  SearchProduct(Request $request){
        $rules = [
            'search' => 'required'
        ];
        $messages = [
            'search.required' => 'Введите название '
        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else {
            $data['popularArticle'] = Article::join('article_categories', 'articles.cat_id', '=', 'article_categories.id')->select('articles.*', 'name')->orderBy('views', 'desc')->first();
            $data['cats'] = Article_category::get();

            $data['articles'] = Article::join('article_categories', 'articles.cat_id', '=', 'article_categories.id')->select('articles.*', 'name')->orderBy('views', 'desc')->paginate(4);
            $data['products'] = Product::where('title','LIKE','%'.$request['search'].'%')->orderBy('id','desc')->paginate(6);


            $data['NewArticles'] = Article::join('article_categories', 'articles.cat_id', '=', 'article_categories.id')->select('articles.*', 'name')->orderBy('created_at', 'desc')->paginate(4);
            return view('shop', $data);
        }
    }

    public function Product($productId){
        $data['cats'] = Article_category::get();
        $data['product'] = Product::find($productId);
        $data['NewArticles'] = Article::join('article_categories','articles.cat_id','=','article_categories.id')->select('articles.*','name')->orderBy('created_at','desc')->paginate(4);



        return view('product',$data);
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
