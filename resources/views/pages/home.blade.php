<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing Page Concept</title>
    <link rel="stylesheet" href="{{ url('frontend/styles/style.css')}}">
    <script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
</head>
<body>
    <div class="temp"></div>
    <div class="first-block"></div>
    <div class="second-block"></div>
    <div class="loader">
        <ul>
            <li>L</li>
            <li>O</li>
            <li>A</li>
            <li>D</li>
            <li>I</li>
            <li>N</li>
            <li>G</li>
        </ul>
    </div>
    <div class="third-block"></div>
    <div class="menu">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
                <button class="btn btn-primary" type="submit" style="border: none; background: none;"><ion-icon name="play"></ion-icon><ion-icon name="play"></ion-icon></button>
            </a>
        </form>
    </div>
    <div class="logo">
        <a href="{{ route('home') }}">
            <span style="color: black">T R A V E L G O</span>
        </a>
    </div>
    <div class="content">
        <div class="heading">
            <span>Lombok Island</span>
        </div>
        <div class="desc">
            <p>Life is short, and the world is vast. Discover new destinations, experiences, and beautiness. Let's start exploring together and plan your dream trip today!</p>
            <br>
        </div>
        <div class="link">
            <button type="button" class="button-visit" onclick="window.location.href= '{{ route('travel') }}';">VISIT NOW</button>
        </div>
    </div>
    <div class="img">
        <img src="{{ url('frontend/images/hero.jpg')}}" alt="">
    </div>
    <div class="media">
        <ul>
            <li><ion-icon name="logo-facebook"></ion-icon></li>
            <li><ion-icon name="logo-instagram"></ion-icon></li>
            <li><ion-icon name="logo-twitter"></ion-icon></li>
        </ul>
    </div>


    
    

    <script type="text/javascript">

    TweenMax.from(".logo", 1.6, {
        delay: 6.4,
        opacity: 0,
        y: 30,
        ease: Expo.easeInOut
    });

    TweenMax.from(".menu", 1.6, {
        delay: 6.5,
        opacity: 0,
        y: 30,
        ease: Expo.easeInOut
    });

    TweenMax.from(".heading", 1.6, {
        delay: 6.6,
        opacity: 0,
        y: 30,
        ease: Expo.easeInOut
});

    TweenMax.from(".desc", 1.6, {
        delay: 6.7,
        opacity: 0,
        y: 30,
        ease: Expo.easeInOut
    });

    TweenMax.from("button", 1.6, {
        delay: 6.8,
        opacity: 0,
        y: 30,
        ease: Expo.easeInOut
    });

    TweenMax.from(".watch", 1.6, {
        delay: 6.9,
        opacity: 0,
        y: 30,
        rotation: 90,
        ease: Expo.easeInOut
    });

    TweenMax.staggerFrom(".media ul li", 2, {
        delay: 7,
        opacity: 0,
        y: 40,
        ease: Expo.easeInOut
    }, 0.2);

    </script>
</body>
</html>
