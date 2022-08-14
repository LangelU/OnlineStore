<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/newprod.css') }}">
    <title>CrearProducto</title>
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
        <div class="container">
            <div class="dataContainer">
                <div class="headerDataContainer">
                    <h3>Crear producto nuevo</h3>
                </div>
            <form action="{{route('addProduct')}}" method="POST">
                @csrf
                <br>
                <table>
                    <thead>
  
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Referencia: </label></td>
                            <td><input type="text" name="reference"></td>
                        </tr>

                        <tr>
                            <td><label>Nombre del producto: </label></td>
                            <td><input type="text" name="prod_name"></td>
                        </tr>
                            
                        <tr>
                            <td><label>Detalles del producto:</label></td>
                            <td><textarea name="prod_details" cols="30" rows="10"></textarea></td>
                        </tr>

                        <tr>
                            <td><label>Precio del producto:</label></td>
                            <td><input type="number" name="prod_price"></td>
                        </tr>

                        <tr>
                            <td><label>Iva: </label></td>
                            <td><input type="number" name="prod_iva" step="0.01"></td>
                        </tr>

                        <tr>
                            <td><label>Unidades disponibles: </label></td>
                            <td><input type="number" name="prod_stock"></td>
                        </tr>

                        <tr>
                            <td><label>Marca: </label></td>
                            <td><input type="text" name="prod_brand"></td>
                        </tr>

                        <tr>
                            <td><label>Modelo: </label></td>
                            <td><input type="text" name="prod_model"></td>
                        </tr>

                        <tr>
                            <td><label>Categoría: </label></td>
                            <td>
                                <select name="prod_category">
                                <?php
                                $connection =  mysqli_connect("localhost", "root", "", "onlinestore"); 
                                $sql = mysqli_query($connection, "SELECT ID, category FROM categories");
                                while ($row = $sql->fetch_assoc()){
                                echo "<option value=\"". $row['ID']. "\">" . $row['category'] . "</option>";
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </form>
            </div>
        </div>
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