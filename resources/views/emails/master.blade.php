<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body style="margen:0px; padding: 0px; background-color: #f3f3f3;">
    <div style="width:60%; max.width:728px; margin:0px auto; display:block;">
        <img src="{{ url('/static/img/emails.png') }}" style="width:100%; display:block;">
        <div style="background-color: #fff; padding:24px;">
            @yield('content')
            <hr>
            <div style="margin-top: 16px;">
                <p>Encuéntranos en nuestras redes sociales:</p>
                @if (config('cms.social_facebook') != "")
                    <a href="{{config('cms.social_facebook')}}" target="_blank" style="display: inline-block; margin-right: 6px; border-radius: 8px;">
                        <img src="{{ url('/static/img/facebook.png') }}" style="width: 30px;">
                    </a>
                @endif
                @if (config('cms.social_instagram') != "")
                    <a href="{{config('cms.social_instagram')}}" target="_blank" style="display: inline-block; margin-right: 6px; border-radius: 8px;">
                        <img src="{{ url('/static/img/instagram.png') }}" style="width: 30px;">
                    </a>
                @endif
                @if (config('cms.social_twitter') != "")
                    <a href="{{config('cms.social_twitter')}}" target="_blank" style="display: inline-block; margin-right: 6px; border-radius: 8px;">
                        <img src="{{ url('/static/img/twitter.png') }}" style="width: 30px;">
                    </a>
                @endif
                @if (config('cms.social_youtube') != "")
                    <a href="{{config('cms.social_youtube')}}" target="_blank" style="display: inline-block; margin-right: 6px; border-radius: 8px;">
                        <img src="{{ url('/static/img/youtube.png') }}" style="width: 30px;">
                    </a>
                @endif
                @if (config('cms.social_whatsapp') != "")
                    <a href="{{config('cms.social_whatsapp')}}" target="_blank" style="display: inline-block; margin-right: 6px; border-radius: 8px;">
                        <img src="{{ url('/static/img/whatsapp.png') }}" style="width: 30px;">
                    </a>
                @endif
                @if (config('cms.social_tiktok') != "")
                    <a href="{{config('cms.social_tiktok')}}" target="_blank" style="display: inline-block; margin-right: 6px; border-radius: 8px;">
                        <img src="{{ url('/static/img/tiktok.png') }}" style="width: 30px;">
                    </a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>