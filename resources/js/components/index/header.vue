<template>
  <div id="index-header">
    <div id="index-header-content">

      <div id="logo">
        <a href="">
          <!--<img src="img/logo/logo.png" id="logo-img" alt="">-->
          <h1>Freedom Bay</h1>
          <p>El lugar de la libertad</p>
        </a>
      </div>

      <div id="search-bar">
        <div class="input-group mb-3" id="search">
          <input id="search-input" type="text" class="form-control" placeholder="Busqueda" aria-label="Busqueda" aria-describedby="button-addon2">
          <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-search" id="search-icon"></i></button>
        </div>
      </div>

    </div>

    <nav>
      <ul>
        <a href="" rel="nofollow"><li>Inicio</li></a>
        <a href="" rel="nofollow"><li>Social</li></a>
        <a href="" rel="nofollow"><li>Mercado</li></a>
        <a href="" rel="nofollow"><li>Blogspot</li></a>
        
      </ul>
    </nav>

  </div>
</template>

<script>
export default {
    mounted() {
      
    },
}
</script>

<style scoped>
  #index-header {
    background-color: #628EDB;

    width: 100%;
    height: 100px;
  }

  #index-header-content {
    height: 70%;

    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;

    padding: .5em;
    position: relative;

  }

  #search-bar {
    width: 50%;
    margin-left: 5.0%;
  }

  #search {
    margin:0 !important;
  }

  #search-input {
    border-color: white;
    border-radius: 0%;
  } 

  #search-input:focus {
    pointer-events: none;
    box-shadow: none;
    border-color: white;
  }

  #button-addon2 {
    transition: .3s;
    border-color: white;
    border-radius: 0%;


  }

  #button-addon2:hover {
    background-color: white;
  }

  #search-icon {
    color: white;
    transition: .3s;

  }

  #button-addon2:hover  #search-icon {
    color:black
  }

  #logo {
    position: absolute;
    top: 50%;
    left: 0;

    transform: translateY(-25%);
    margin-left: 4em;
  }

  #logo>a {
    color:white;
    text-decoration: none;
  }

  nav {
    background-color: #628EDB;
  }

  ul {
    display: flex;
    align-content: center;
    justify-content: center;
  }

  li {
    list-style: none;

    margin-left: 1em;
    margin-right: 1em;
    margin-top: 0;

    padding: .6em;
    color: white;

    max-width: 100px;
    min-width: 100px;

    text-align: center;

    transition:.3s;
  }

  li:hover {
    color: black;
    background: white;
  }

  ul>a {
    text-decoration: none;
  }

  p {
    margin-left: .15em;
  }

</style>