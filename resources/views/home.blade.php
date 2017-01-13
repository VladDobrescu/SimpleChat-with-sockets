<!DOCTYPE html>
<html>
<head>
    <title>SimpleChat</title>
    {{--<meta http-equiv="refresh" content="5" >--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/vendor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/flat-admin.css') }}">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>

</head>
<body>
<div class="app app-default">

    <script type="text/ng-template" id="sidebar-dropdown.tpl.html">
        <div class="dropdown-background">
            <div class="bg"></div>
        </div>
        <div class="dropdown-container">
        </div>
    </script>
    <div class="app-container app-full">
        <div class="app-messaging-container">
            <div class="app-messaging" id="collapseMessaging">
                <div class="chat-group">
                    <div class="heading"><span style="font-size: 1.5em">SimpleChat</span></div>
                    <ul id="username" class="group full-height">
                        <li id="users" class="section">Users</li>
                                    <!--Append user -->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="messaging">
                    <div class="heading">
                        <div class="title">
                            <span style="visibility: hidden;" class="badge badge-success badge-icon"><i class="fa fa-circle" aria-hidden="true"></i></span></div>
                        <div class="action"></div>
                    </div>
                    <ul  id="chat-window"  class="chat">

                        {{--Other users wrote--}}
                        {{--@foreach($messages as $message)--}}
                        {{--<li>--}}
                        {{--<div class="message"><b><span>{{ $message->author->name }} :</span></b><br/>{{ $message->message }}</div>--}}
                        {{--<div class="info">--}}
                        {{--<div class="datetime">{{$message->created_at->format('H:i')}}</div>--}}
                        {{--</div>--}}
                        {{--</li>--}}
                        {{--@endforeach--}}
                        {{--<li id="single-message">--}}
                            {{--<div class="message"><b><span>auth_name :</span></b><br/></div>--}}
                            {{--<div class="info">--}}
                            {{--<div class="datetime">stamps</div>--}}
                            {{--</div>--}}
                        {{--</li>--}}

                    </ul>
                    <div class="footer">
                        <form  action="{{ action('socketController@send') }}" method="POST" class="message-box">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="user" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                            <textarea id="message" name="message" placeholder="type something..." class="form-control" autofocus></textarea>
                            <input id="submit" style="position: relative;" type="submit"  name='save' class="btn btn-success" value = "Send"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('/js/vendor.js') }}"></script>
<script type="text/javascript" src="{{asset('/js/app.js') }}"></script>
<script>
    var rand = function() {
        return Math.random().toString(36).substr(2); // remove `0.`
    };

    var token = function() {
        return rand() + rand(); // to make it longer
    };
    var rand = token();


    var socket = io.connect('http://homestead.app:8890');

    socket.on('message', function (data) {
        data = jQuery.parseJSON(data);
        console.log(data);
//        if($('#username').innerHTML.indexOf(data.user) != data.user) {
            $("#username").append('<li id="messages" class="message"><a data-toggle="collapse" href="#collapseMessaging" aria-expanded="false" aria-controls="collapseMessaging"><div class="message"><img class="profile" src="/images/usr-default.png"><div class="content"><div class="title">' + data.user + '</div></div></div></a></li>');
//        }
        $( "#chat-window" ).append('<li id="single-message"><div class="message"><b><span>'+data.user+' :</span></b><br/>'+data.message+'</div><div class="info"></div></li>');
    });
    $("#submit").click(function(e){
        e.preventDefault();
        var token = $("input[name='_token']").val();
        var user = $("input[name='user']").val();
        var message = $("#message").val();
        if(message != ''){
            $.ajax({
                type: "POST",
                url: '{!! URL::to("/send") !!}',
                dataType: "json",
                data: {'_token':token,'message':message,'user':user},
                success:function(data){
                    console.log(data);
                    $("#message").val('');
                }
            });
        }else{
            alert("You need to write something");
        }
    });

</script>



</body>
</html>