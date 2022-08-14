<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/prodetails.css') }}">
    <title>OnlineStore</title>
</head>
<body>
<div class="sideBar">
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <!--<img src="logo.png" alt="">-->
                </span>

                <div class="text logo-text">
                    <span class="name">OnlineStore</span>
                    <span class="profession"></span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Buscar...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="{{route('products')}}">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Catálogo</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{route('categories')}}">
                            <i class='bx bx-bar-chart-alt-2 icon' ></i>
                            <span class="text nav-text">Categorías</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{route('newProdView')}}">
                            <i class='bx bx-bar-chart-alt-2 icon' ></i>
                            <span class="text nav-text">Crear producto</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

    <section class="home">
        <h1>Online Store</h1>
        @foreach ($prodData as $product)
        <div class="container">
            <div class="dataContent">
                <h2>{{$product->name}}</h2>
                <div class="dataContainer">
                    <label>Referencia: {{$product->reference}}</label>
                    <br>
                    <br>
                    <label>Detalles: {{$product->details}}</label>
                    <br>
                    <br>
                    <label>Precio: ${{$product->price}}</label>
                    <br>
                    <br>
                    <label>Unidades disponibles: {{$product->stock}}</label>
                    <br>
                    <br>
                    <label>Marca: {{$product->brand}}</label>
                    <br>
                    <br>
                    <label>Modelo: {{$product->model}}</label>
                    <br>
                    <br>
                    <label>Iva: {{$product->iva}}</label>
                </div>
                
                <div class="buyButtons">
                    <button>Añadir al carrito</button>
                    <br>
                    <button>Comprar</button>
                </div>
                
            </div>

            <div class="pictureContent">
                <img src="{{asset('img/'.$product->picture.'.png')}}">
            </div>
        </div>
        @endforeach
    </section>
    </div>
</body>
</html>
<script>
    const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
    sidebar.classList.remove("close");
})
</script>