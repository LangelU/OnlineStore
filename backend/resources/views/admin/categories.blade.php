<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/adminCat.css') }}">
    <title>User</title>
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
                    <span class="name">Bienvenido</span>
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
                            <span class="text nav-text">Productos</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{route('categories')}}">
                            <i class='bx bx-bar-chart-alt-2 icon' ></i>
                            <span class="text nav-text">Categorías</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Historial de ventas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-pie-chart-alt icon' ></i>
                            <span class="text nav-text">Estadísticas</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="{{route('home')}}">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            
            </div>
        </div>

    </nav>

    <section class="home">
        <h1>Online Store</h1>
        <div class="backContent">
            <h4>Categorías
                <button class="btn btn-primary" id="myBtn">Añadir</button>
            </h4>
            <br>
            <table>
                <thead>
                    
                </thead>
        
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->category}}</td>
                        <td><button id="editCategory">Editar</button></td>
                        <form action="{{route('deleteCat', $category->ID)}}" method="POST">
                            <td><button type="submit">Eliminar</button></td>   
                        </form>
                        
                    </tr>
                @endforeach 
                </tbody>
            </table>
        </div>
        
    </section>
    </div>

    <!-- Modal -->
    <!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
    <div class="modal-header">
        <span class="close">&times;</span>
        <h2>Añadir categoría</h2>
    </div>
    <div class="modal-body">
        <form action="{{route('newCategory')}}" method="POST">
            @csrf
            <input type="text" id="cat_name" name="cat_name" placeholder="Nombre de categoria...">
            <button type="submit">Añadir</button>
            <br>
        </form>
    </div>
    </div>
</div>

<div id="updCategory" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
    <div class="modal-header">
        <span class="close">&times;</span>
        <h2>Editar categoría</h2>
    </div>
    <div class="modal-body">
        <form action="{{route('upCategory', $category->ID)}}" method="POST">
            @method('PUT')
            @csrf
            <input type="text" id="cat_name" name="cat_name" placeholder="Nombre de categoria...">
            <button type="submit">Actualizar</button>
            <br>
        </form>
    </div>
    </div>
</div>
</body>
</html>

<script>
    // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
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

//Edit category Modal
var modal2 = document.getElementById("updCategory");

// Get the button that opens the modal
var btn2 = document.getElementById("editCategory");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn2.onclick = function() {
  modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
}
</script>