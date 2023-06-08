<template>
    <div class="header-menu">
        <div class="hamburger-menu">
            <label for="menu-btn-check" class="menu-btn"><span></span></label>
        </div>
        <div class="center">
            <h1 class="header-logo">Rese</h1>
        </div>
    </div>
    <div class="registration">
        <div class="registration-ttl">Registration</div>
        <div class="form-item">
            <label for="username" class="username-label"></label>
            <input
                id="username"
                type="text"
                v-model="username"
                placeholder="Username"
            />
        </div>
        <div class="form-item">
            <label for="email" class="email-label"></label>
            <input id="email" type="text" v-model="email" placeholder="Email" />
        </div>
        <div class="form-item">
            <label for="password"></label>
            <input
                id="password"
                type="text"
                v-model="password"
                placeholder="Password"
            />
        </div>
        <div class="form-item">
            <button
                @click="registration(username, email, password)"
                class="registration-btn"
            >
                登録
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            username: "",
            email: "",
            password: "",
        };
    },
    methods: {
        async registration(UserName, eMail, passWord) {
            await axios.post("http://localhost:8000/api/v1/user", {
                name: UserName,
                email: eMail,
                password: passWord,
            });
            this.$router.push({ name: "registerthanks" });
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
.registration {
    margin: 0 auto;
    transform: translate(0, 200px);
    width: 30%;
    border-radius: 5px;
    box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);
}

.registration-ttl {
    padding: 15px;
    background-color: #077af2;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    color: white;
    font-weight: bold;
}
#email,
#password,
#username {
    width: 80%;
    margin: 10px 0 10px 25px;
    border: none;
    border-bottom: 2px solid #ebebeb;
}
.registration-btn {
    background-color: #077af2;
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    margin-left: 75%;
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
