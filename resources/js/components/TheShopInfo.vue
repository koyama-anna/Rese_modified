<template>
  <div class="body">
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
    <div class="all">
      <div class="shop-detail">
        <div class="title">
          <router-link :to="{ name: 'theshopall' }" class="back"
            >＜</router-link
          >
          <div class="shop-name">{{ shop.name }}</div>
        </div>
        <div class="shop-photo"><img :src="shop.photo" alt="" /></div>
        <div class="tag">
          <div class="shop-area">#{{ shop.area }}</div>
          <div class="shop-genre">#{{ shop.genre }}</div>
        </div>
        <div class="shop-information">{{ shop.information }}</div>
      </div>
      <div class="reservation">
        <div class="reservation1">
          <div class="re-title">予約</div>
          <div class="input">
            <form class="re-information">
              <div class="in-date">
                <input v-model="date" type="date" class="in-date1" require />
              </div>
              <div class="in-time">
                <select name="time" v-model="time" class="in-time1" require>
                  <option>9:00</option>
                  <option>10:00</option>
                  <option>11:00</option>
                  <option>12:00</option>
                  <option>13:00</option>
                  <option>14:00</option>
                  <option>15:00</option>
                  <option>16:00</option>
                  <option>17:00</option>
                  <option>18:00</option>
                  <option>19:00</option>
                  <option>20:00</option>
                  <option>21:00</option>
                </select>
              </div>
              <div class="in-number">
                <select
                  name="number"
                  v-model="number"
                  class="in-number1"
                  require
                >
                  <option value="1">1人</option>
                  <option value="2">2人</option>
                  <option value="3">3人</option>
                  <option value="4">4人</option>
                  <option value="5">5人</option>
                  <option value="6">6人</option>
                  <option value="7">7人</option>
                  <option value="8">8人</option>
                  <option value="9">9人</option>
                  <option value="10">10人</option>
                </select>
              </div>
            </form>
          </div>
          <div class="output">
            <table class="out-table">
              <tr class="out-shop">
                <th>Shop</th>
                <td>{{ shop.name }}</td>
              </tr>
              <tr class="out-date">
                <th>Date</th>
                <td>{{ date }}</td>
              </tr>
              <tr class="out-time">
                <th>Time</th>
                <td>{{ time }}</td>
              </tr>
              <tr class="out-number">
                <th>Number</th>
                <td>{{ number }}人</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="re-btn">
          <button @click="reserve(shop.id, date, time, number)" class="re-btn1">
            予約する
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      shop: [],
      date: "",
      time: "",
      number: "",
    };
  },

  async mounted() {
    const item = await axios.get(
      `http://localhost:8000/api/v1/shop/${this.$route.params.id}`
    );
    console.log(item);
    const shopData = item.data;
    this.shop = shopData.data;
  },

  methods: {
    async reserve(shopId, reserveDate, reserveTime, reserveNumber) {
      await axios.post("http://localhost:8000/api/v1/reservation", {
        shop_id: shopId,
        date: reserveDate,
        time: reserveTime,
        number: reserveNumber,
      });
      this.$router.push({ name: "reservedone" });
    },
    menu() {
      this.$router.push("/menu");
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
.body {
  background-color: #ebebeb;
}

.all {
  display: flex;
  padding-top: 60px;
  padding-bottom: 500px;
}

.shop-detail {
  width: 45%;
  margin: 15px 30px;
}

.header-logo {
  height: 70px;
  line-height: 70px;
  color: #0080ff;
}

.title {
  display: flex;
}

.back {
  border: 2px solid white;
  border-radius: 5px;
  box-shadow: 5px 5px 2px #ccc;
  font-weight: bold;
  background-color: white;
  color: black;
  text-decoration: none;
  padding: 5px 5px;
}

.shop-name {
  font-size: 24px;
  font-weight: bold;
  margin: 0 10px;
}

img {
  width: 100%;
  margin: 20px 0;
}

.tag {
  display: flex;
  font-size: 14px;
}

.shop-information {
  font-size: 14px;
  line-height: 150%;
  margin: 20px 0;
}

.reservation {
  background-color: #0080ff;
  border-radius: 5px;
  width: 45%;
  padding: 0 20px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.re-title {
  color: white;
  font-size: 20px;
  font-weight: bold;
  margin-top: 25px;
  margin-bottom: 15px;
}

.in-date1 {
  border-radius: 5px;
  width: 35%;
  border: none;
  outline: none;
  line-height: 20px;
  font-weight: lighter;
  margin: 5px 0;
  font-size: 12px;
}

.in-time1 {
  border-radius: 5px;
  width: 95%;
  border: none;
  outline: none;
  padding: 5px 0;
  font-size: 12px;
  margin: 5px 0;
}

.in-number1 {
  border-radius: 5px;
  width: 95%;
  border: none;
  outline: none;
  padding: 5px 0;
  font-size: 12px;
  margin: 5px 0;
}

.output {
  background-color: #80bfff;
  border-radius: 5px;
  width: 90%;
  color: white;
  padding: 15px 10px;
  text-align: left;
  margin-top: 10px;
}

th,
td {
  padding: 5px 0;
  font-weight: normal;
}

td {
  padding-left: 10px;
}

.re-btn1 {
  border: none;
  background: transparent;
  background-color: #0073e6;
  color: white;
  font-size: 12px;
  width: 120%;
  display: block;
  margin-top: auto;
  padding: 10px 0;
  margin: 0 -20px;
  border-radius: 0 0 5px 5px;
}
.re-btn {
  display: flex;
  text-align: center;
}
</style>
