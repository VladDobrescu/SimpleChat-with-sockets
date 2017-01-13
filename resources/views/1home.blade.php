<!DOCTYPE html>
<html>
<head>
    <title>SimpleChat</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/vendor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/flat-admin.css')}}">
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
                    <ul class="group full-height">
                        <li class="section">Online Users</li>
                        <li class="message">
                            <a data-toggle="collapse" href="#collapseMessaging" aria-expanded="false" aria-controls="collapseMessaging">
                                <span class="badge badge-warning pull-right">10</span>
                                <div class="message">
                                    <img class="profile" src="https://placehold.it/100x100">
                                    <div class="content">
                                        <div class="title">John Doe</div>
                                        <div class="description">Status</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message">
                            <a data-toggle="collapse" href="#collapseMessaging" aria-expanded="false" aria-controls="collapseMessaging">
                                <span class="badge badge-warning pull-right">10</span>
                                <div class="message">
                                    <img class="profile" src="https://placehold.it/100x100">
                                    <div class="content">
                                        <div class="title">Other John Doe</div>
                                        <div class="description">Status</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="messaging">
                    <div class="heading">
                        <div class="title">
                            echo user name <span class="badge badge-success badge-icon"><i class="fa fa-circle" aria-hidden="true"></i></span>
                        </div>
                        <div style="margin: 0 auto; float: right;" class="pull-right">
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <a href="{{ url('/logout') }}" style="margin: 0 auto;float: right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-info"  role="button">Log out</a>
                        </div>
                        <div class="action"></div>
                    </div>
                    <ul class="chat">
                        <li>
                            <div class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</div>
                            <div class="info">
                                <div class="datetime">11.45pm</div>
                                <div class="status"><i class="fa fa-check" aria-hidden="true"></i> Read</div>
                            </div>
                        </li>
                        <li class="right">
                            <div class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</div>
                            <div class="info">
                                <div class="datetime">11.46pm</div>
                            </div>
                        </li>
                    </ul>
                    <div class="footer">
                        <div class="message-box">
                            <textarea placeholder="type something..." class="form-control"></textarea>
                            <button class="btn btn-default"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>Send</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('/js/vendor.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/app.js')}}"></script>
<script>
    var socket = io.connect('http://homestead.app:8890');
    socket.on('message', function (data) {
        $( "#messages" ).append( "<p>"+data+"</p>" );
    });
</script>

</body>
</html>