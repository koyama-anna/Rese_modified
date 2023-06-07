<template>
    <div class="header-menu">
        <div class="hamburger-menu">
            <label for="menu-btn-check" class="menu-btn" @click="menu"
                ><span></span
            ></label>
        </div>
        <div class="center">
            <h1 class="header-logo">Rese</h1>
        </div>
    </div>
    <div class="login">
        <div class="login-ttl">Login</div>
        <div class="form-item">
            <label for="email">Email</label>
            <input id="email" type="text" v-model="email" />
        </div>
        <div class="form-item">
            <label for="password">Password</label>
            <input id="password" type="text" v-model="password" />
        </div>
        <div class="form-item">
            <button @click="handle()">Login</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        async handle() {
            const token = (
                await axios.post("http://localhost:8000/api/login", {
                    email: this.email,
                    password: this.password,
                })
            ).data.token;
            axios.defaults.headers.common["Authorization"] = `Bearer ${token}`; // axiosのすべてのリクエストにトークンを付加する
            localStorage.setItem("token", token);
            this.$router.push({ name: "theshopall" });
        },
    },
};
</script>

<style scoped>
.flex {
    display: flex;
    flex-wrap: wrap;
    padding: 0 50px;
}

.header-logo {
    position: fixed;
    height: 70px;
    line-height: 70px;
    margin-left: 70px;
    margin-top: 5px;
}
.center {
    font-size: 20px;
    font-weight: bold;
    color: #077af2;
}

.header {
    display: flex;
    justify-content: space-between;
}

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
    background-color: #ffffff;
    position: absolute;
}
.menu-btn span:before {
    bottom: 8px;
}
.menu-btn span:after {
    top: 8px;
}
.form-item {
    margin: 0 auto;
    text-align: center;
}

label {
    display: block;
}

input {
    width: 50%;
    padding: 0.5em;
    font: inherit;
}

button {
    padding: 0.5em;
    margin: 1em;
}
</style>
