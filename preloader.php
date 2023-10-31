<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <title>Document</title>

</head>

<style>
    .loaderClass .preloader {
        margin: 0;
        padding: 0;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* background: #000; */
        transition: 1s;
    }

    .loaderClass .preloader:before {
        content: '';
        position: absolute;
        left: 0;
        width: 50%;
        height: 100%;
        background: #000;
        transition: 1s;
    }

    .loaderClass .preloader.complete:before {
        left: -50%;
    }

    .loaderClass .preloader:after {
        content: '';
        position: absolute;
        right: 0;
        width: 50%;
        height: 100%;
        background: #000;
        transition: 1s;
    }

    .loaderClass .preloader.complete:after {
        right: -50%;
    }

    .loaderClass .loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        box-sizing: border-box;
        border: 3px solid #fff;
        animation: animate 2s linear infinite;
        z-index: 10000;
    }

    .loaderClass .loader:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #fff;
        animation: animatebg 2s linear infinite;
    }
    .loaderClass .preloader.complete {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
    @keyframes animate 
    {
        0% 
        {
            transform: translate(-50%, -50%) rotate(0deg);
        }
        25% 
        {
            transform: translate(-50%, -50%) rotate(180deg);
        }
        50% 
        {
            transform: translate(-50%, -50%) rotate(180deg);
        }
        75% 
        {
            transform: translate(-50%, -50%) rotate(360deg);
        }
        100% 
        {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }
    @keyframes animatebg 
    {
        0% 
        {
            height: 0;
        }
        25% 
        {
            height: 0;
        }
        50% 
        {
            height: 100%;
        }
        75% 
        {
            height: 100%;
        }
        100% 
        {
            height: 0;
        }
    }
</style>


<body>

    <script type="text/javascript">
        $(window).on('load', function() {
            $('.preloader').addClass('complete')
        })
    </script>

    <div class="loaderClass">
        <div class="preloader">
            <div class="loader">
            </div>
        </div>
    </div>

</body>

</html>