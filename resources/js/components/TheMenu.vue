<template>
  <div class="all">
    <div class="hamburger-menu">
      <label for="menu-btn-check" class="menu-btn" @click="$router.go(-1)"
        ><span></span
      ></label>
    </div>
    <div class="menu">
      <div>
        <router-link to="/" class="home">Home</router-link>
      </div>
      <div>
        <router-link to="/login" class="login">Login</router-link>
      </div>
      <div>
        <router-link to="/mypage" class="mypage">Mypage</router-link>
      </div>
    </div>
  </div>
</template>
<script></script>
<style scoped>
.menu-btn {
  position: fixed;
  top: 10px;
  left: 10px;
  display: flex;
  height: 40px;
  width: 40px;
  justify-content: center;
  align-items: center;
  z-index: 90;
  background-color: #077af2;
  margin: 10px 10px;
  border-radius: 5px;
  box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);
}
.menu-btn span,
.menu-btn span:before,
.menu-btn span:after {
  content: "";
  display: block;
  height: 3px;
  width: 25px;
  border-radius: 3px;

  position: absolute;
}
.menu-btn span:before {
  background-color: #ffffff;
  bottom: 0;
  transform: rotate(45deg);
}
.menu-btn span:after {
  background-color: #ffffff;
  top: 0;
  transform: rotate(-45deg);
}

.menu {
  width: 100px;
  margin: 0 auto;
  margin-top: 20%;
}

.home,
.login,
.mypage {
  text-decoration: none;
  color: #077af2;
  font-size: 25px;
  font-weight: 500;
  line-height: 150%;
}
</style>
