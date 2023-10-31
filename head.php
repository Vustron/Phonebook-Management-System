<!-- Head -->
<!-- Head -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Phonebook Management System V7</title>

    <link rel="icon" href="upload/address-book-solid.svg" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <!--css fontawesome-->
    <link href="css/all.css">
</head>

<style>
    @import url('http://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

    .sidebar {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 50px;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', 'sans-serif';
        background: #2b343b;
    }

    .sidebar .navigation {
        position: relative;
        height: 100vh;
        width: 75px;
        background: #2b343b;
        box-shadow: 10px 0 0 #4187f6;
        border-left: 10px solid #2b343b;
        overflow: hidden;
        transition: width 0.5s;
    }

    .sidebar .navigation:hover {
        width: 315px;
    }

    .sidebar .navigation ul {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        padding-left: 5px;
        padding-top: 40px;
    }

    .sidebar .navigation ul li {
        position: relative;
        list-style: none;
        width: 100%;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .sidebar .navigation ul li.active {
        background: #4187f6;
    }

    .sidebar .navigation ul li a {
        position: relative;
        display: block;
        width: 100%;
        display: flex;
        text-decoration: none;
        color: #fff;
    }

    .sidebar .navigation ul li.active a::before {
        content: '';
        position: absolute;
        top: -30px;
        right: 0;
        width: 30px;
        height: 30px;
        background: none;
        border-radius: 50%;
        box-shadow: 15px 15px 0 #4187f6;

    }

    .sidebar .navigation ul li.active a::after {
        content: '';
        position: absolute;
        bottom: -30px;
        right: 0;
        width: 30px;
        height: 30px;
        background: #2b343b;
        border-radius: 50%;
        box-shadow: 15px -15px 0 #4187f6;

    }

    .sidebar .navigation ul li a .icon {
        position: relative;
        display: block;
        min-width: 60px;
        height: 60px;
        line-height: 70px;
        text-align: center;
    }

    .sidebar .navigation ul li a .icon ion-icon {
        position: relative;
        font-size: 1.5em;
        z-index: 1;

    }

    .sidebar .navigation ul li a .icon i {
        margin-top: 10px;
        margin-right: 20px;
        margin-bottom: 50px;
        display: flex;
        position: absolute;
        font-size: 3em;
        width: 10px;
        height: 10px;
        z-index: 2;

    }

    .sidebar .navigation ul li a .title {
        position: relative;
        display: block;
        padding-left: 5px;
        height: 50px;
        line-height: 60px;
        white-space: nowrap;
    }

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

    @keyframes animate {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        25% {
            transform: translate(-50%, -50%) rotate(180deg);
        }

        50% {
            transform: translate(-50%, -50%) rotate(180deg);
        }

        75% {
            transform: translate(-50%, -50%) rotate(360deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    @keyframes animatebg {
        0% {
            height: 0;
        }

        25% {
            height: 0;
        }

        50% {
            height: 100%;
        }

        75% {
            height: 100%;
        }

        100% {
            height: 0;
        }
    }

    .scrollbar1::-webkit-scrollbar {
        width: 0.5em;
    }

    .scrollbar1::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    }

    .scrollbar1::-webkit-scrollbar-thumb {
        background-color: #4187f6;
        border-radius: 5px;
    }

    body::-webkit-scrollbar {
        width: 0.5em;
    }

    body::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    }

    body::-webkit-scrollbar-thumb {
        background-color: #4187f6;
        border-radius: 5px;
    }

    @media only screen and (max-width: 575px) {
        .sidebar {
            width: 80px;
        }

        .sidebar .navigation:hover {
            width: 655px;
        }

        .col-sm-auto {
            width: 80px;
        }
    }

    #icon-s {
        font-size: 100px;
        top:40%;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0 auto;
        text-align: center;
        position: absolute;
    }

    @media only screen and (max-width: 991px) {
        #icon-s {
            font-size: 50px;
            top: 45%;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 0 auto;
            text-align: center;
            position: absolute;
        }
    }

    @media only screen and (max-width: 1080px) {
        span.hidtxt {
            display: none;
        }
    }

    select {
        color: white;
    }

    option {
        color: black;
    }

    .form-s {
        margin: auto;
        background: white;
        border-radius: 40px;
        position: relative;
        padding: 5px;
        width: 50%;
    }

    .search-input {
        width: 100%;
        height: 100%;
        padding: 10px;
        border: none;
        border-radius: 40px;
        background: none;
        color: black;

    }

    .search-input:focus {
        outline: none;
    }


    .search-btn {
        border: none;
        border-radius: 50px;
        position: absolute;
        right: 8px;
        color: black;
        width: 40px;
        height: 40px;
        background-color: white;
        transition: 0.2s ease-out;

    }

    .search-input:not(:placeholder-shown)~.search-btn {
        background-color: #4187f6;
        color: white;
        transition: 0.2s ease-in;
    }

    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        display: none;
    }

    /* Input Profile Picture */
    .upload {
        width: 125px;
        position: absolute;
        margin: auto;
    }

    .upload img {
        border-radius: 50%;
        border: 8px solid #DCDCDC;
    }

    .upload .round {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #00B4FF;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
    }

    .upload .round input[type="file"] {
        position: absolute;
        transform: scale(2);
        opacity: 0;
    }

    input[type=file]::-webkit-file-upload-button {
        cursor: pointer;
    }

</style>