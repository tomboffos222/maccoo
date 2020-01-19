<div class="line">
    <div class="tree">
{{--        <span>{{$user->level}}</span>--}}
        <div data-toggle="modal" data-target="#user_{{$user->id}}">
            <img src="https://cdn0.iconfinder.com/data/icons/user-collection-4/512/user-512.png" class="img-center img-circle propic" width="50px">
        </div>
        <a href="{{route('Tree',$user->id)}}">{{$user->name}}</a>
        <!-- Modal -->
        <div id="user_{{$user->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Информация</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <td>ID</td>
                                <td>{{$user->bs_id}}</td>
                            </tr>
                            <tr>
                                <td>ФИО</td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>Телефон номер</td>
                                <td>{{$user->phone}}</td>
                            </tr>
                            <tr>
                                <td>Логин</td>
                                <td>{{$user->login}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>Дата регистрации</td>
                                <td>{{$user->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Позиция на пирамиде</td>
                                <td>{{$user->row + 1}}</td>
                            </tr>
                            <tr>
                                <td>Условия</td>
                                <td>
                                    @if($user->prize == 'home')
                                        Дом
                                    @elseif($user->prize == 'car')
                                        Автомобиль
                                    @else
                                        Спецтехника
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- end Modal -->
    </div>
    <div class="children">
        @if($i < $maxColumnCount)
            @php
                $users = \App\Models\Tree::join('users','users.id','tree.user_id')->where('parent_id',$user->id)
                ->select('tree.*','name','phone','login','bs_id','prize','email')
                ->get();
            @endphp
            @foreach($users as $user)
                @component('treeUser',['user'=>$user,'maxColumnCount'=>$maxColumnCount,'i'=>$i +1])

                @endcomponent

            @endforeach

            @if(!isset($users[0]))
                <div class="line">
                    <div class="tree"></div>
                </div>
            @endif
            @if(!isset($users[1]))
                <div class="line">
                    <div class="tree"></div>
                </div>
            @endif

        @endif
    </div>
</div>
