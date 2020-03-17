<?php

namespace App\Http\Controllers;

use App\Article;
use App\Article_category;
use App\Models\Admin;
use App\Models\User;
use App\Models\Tree;
use App\OrderProduct;
use App\Orders;
use App\Product_image;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\BlackListed;
use App\Authors;
use App\Categories;
use Illuminate\Http\UploadedFile;
use App\Withdrawal;
use App\Product;
use App\Message;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

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

        $data['categories'] = Categories::paginate(10);



        return view('admin.shop',$data);


    }
    public function WithdrawShow(){
        $data['withdraws'] = Withdrawal::join('users','users.id','=', 'withdrawals.user_id')->select('withdrawals.*','name','phone','login','email')->orderBy('created_at','desc')->paginate(12);

        return view('admin.withdraws',$data);
    }
    public function CreateProduct(Request $request){
        $rules = [
            'image' => 'required|max:5120',
            'title' => 'required',
            'price'=> 'required',
            'category'=>'required',

            'description'=>'required|max:255',
            'stock'=>'required',

        ];
        $messages = [
            "image.required" => "Выберите фото",
            "title.required" =>  "Введите название книги",
            "price.required" => "Введите цену",
            "category.required" => "Выберите категорию",

            "description.required" => "Введите описание",
            "description.max" => "Максимальное число символов в описании 255",
            "stock.required" => "Пометьте как товар в наличии",
        ];
        $validator = $this->validator($request->all(),$rules, $messages);

        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{


            $product = new Product;
            $product['title'] = $request['title'];
            $product['price'] = $request['price'];
            $product['cat_id'] = $request['category'];

            $product['size'] = $request['size'];
            $product['type_of_material'] = $request['type'];

            $product['description'] = $request['description'];

            if ($request->has('stock')){
                $product['status'] = 1;

            }



            if ($request->hasFile('image')){





                $image = $request->file('image');
                $name = Str::random(20).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $name);








                $product['img'] = '/images/'.$name;

            }

            $product->save();

            return back()->with('message','Добавлено ');


        }
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
        $data['users'] = User::paginate(25);
        return view('admin.users',$data);
    }
    public function WithdrawAllow($id){


        $Withdrawal = Withdrawal::find($id);


        $Withdrawal['withdraw_status'] = 'allowed';
        $Withdrawal->save();
        return back()->with('message','Одобрено');

    }
    public  function CreatePost(){
        $data['cats'] = Article_category::get();
        $data['articles']= Article::paginate(5);

        return view('admin.post',$data);
    }
    public  function Posts(){
        $data['cats'] = Article_category::get();
        $data['articles']= Article::paginate(5);

        return view('admin.view_posts',$data);
    }
    public function StoreArticle( Request $request){
        $rules = [
            'title' => 'required',
            'text' => 'required',
            'cat_id' =>  'required',
            'author' => 'required',
            'path' => 'required|mimes:jpeg,bmp,png'
        ];
        $messages = [
            'title.required' => 'Введиет название',
            'text.required' => 'Введите текст поста',
            'cat_id.required' => 'Выбериете категорию',
            'author.required' => 'Введите имя автора',
            'path.required'=> 'Выберите файл',
            'path.mimes' => 'Файл должен быть в формате jpg,png ,bmp',
        ];
        $validator = $this->validator($request->all(),$rules,$messages);

        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else {
            if ($request->hasFile('path')) {
                $article = new Article();
                $article['title'] = $request['title'];
                $article['text'] = $request['text'];
                $article['cat_id'] = $request['cat_id'];
                $article['views'] = 0;
                $article['author'] = $request['author'];
                $img = $request['path'];
                $imgName = Str::random(20) . '.' . $img->getClientOriginalName();
                $path = public_path() . '/images/';
                $img->move($path, $imgName);
                $article['path'] = '/images/' . $imgName;

                $article->save();

                return back()->with('message', 'Добавлено');
            }

        }
    }
    public function  upload(Request $request){
        $path =  public_path().'/images/';
        $file = $request->file('file');
        $filename = Str::random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        $img = Image::make($file);
        $img->save($path . $filename);
        echo '/images/'.$filename;
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
    public function PostCatAdd(Request $request){
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
            $category = new Article_category();
            $category->name = $request['category'];

            $category->save();

            return back()->with('message','Добавлено');
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
    public function ViewPost($articleId){
        $data['cats']  = Article_category::get();
        $data['article'] = Article::join('article_categories', 'articles.cat_id', '=', 'article_categories.id')->where('articles.id',$articleId)->select('articles.*', 'name')->orderBy('created_at', 'desc')->first();



        return view('admin.view_post',$data);

    }
    public function DeletePost($articleId){
        $article = Article::find($articleId);
        $article->delete();
        return back()->with('message','Удалено');
    }
    public function EditPost(Request $request){
        $rules = [
            'title' => 'required',
            'text' => 'required',
            'cat_id' =>  'required',
            'author' => 'required',
            'path' => 'mimes:jpeg,bmp,png',
            'article_id' => 'required'
        ];
        $messages = [
            'title.required' => 'Введиет название',
            'text.required' => 'Введите текст поста',
            'cat_id.required' => 'Выбериете категорию',
            'author.required' => 'Введите имя автора',
            'article_id.required' =>' Введите id',
            'path.mimes' => 'Файл должен быть в формате jpg,png ,bmp',
        ];
        $validator = $this->validator($request->all(),$rules,$messages);

        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else {
            if ($request->hasFile('path')) {

                $article['title'] = $request['title'];
                $article['text'] = $request['text'];
                $article['cat_id'] = $request['cat_id'];
                $article['views'] = 0;
                $article['author'] = $request['author'];
                $img = $request['path'];
                $imgName = Str::random(20) . '.' . $img->getClientOriginalName();
                $path = public_path() . '/images/';
                $img->move($path, $imgName);
                $article['path'] = '/images/' . $imgName;

                $article->save();

                return back()->with('message', 'Добавлено');
            }else{
                $article = new Article();
                $article['title'] = $request['title'];
                $article['text'] = $request['text'];
                $article['cat_id'] = $request['cat_id'];
                $article['views'] = 0;
                $article['author'] = $request['author'];
                $img = $request['path'];
                $imgName = Str::random(20) . '.' . $img->getClientOriginalName();
                $path = public_path() . '/images/';
                $img->move($path, $imgName);
                $article['path'] = '/images/' . $imgName;

                $article->save();
            }

        }

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
