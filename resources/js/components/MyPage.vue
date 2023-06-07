<template>
    <div class="all">
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
        <div class="reservation">
            <div class="left_reserve">
                <div class="reserve">予約状況</div>
                <div
                    v-for="(reservation, index) in reservations"
                    :key="reservation.id"
                    class="reserve-card"
                >
                    <div class="reserve-no">
                        <div class="reserve-ttl">
                            <div class="reserve-name">予約{{ index + 1 }}</div>
                            <div
                                class="cancel-btn"
                                @click="deleteReserve(reservation.id)"
                            >
                                ×
                            </div>
                        </div>
                        <div class="reserve-list">
                            <table class="list-table">
                                <tr class="list-shop">
                                    <th>Shop</th>
                                    <td>{{ shopName(reservation.shop_id) }}</td>
                                </tr>
                                <tr class="list-date">
                                    <th>Date</th>
                                    <td>{{ reservation.date }}</td>
                                </tr>
                                <tr class="list-time">
                                    <th>Time</th>
                                    <td>{{ reservation.time }}</td>
                                </tr>
                                <tr class="list-number">
                                    <th>Number</th>
                                    <td>{{ reservation.number }}人</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mypage">
                <div class="login-name">{{ user.name }}さん</div>
                <div class="favorite-card">
                    <div class="favorite-tytle">お気に入り店舗</div>
                    <div class="favorite-shop">
                        <div v-for="shop in getFavoriteShops" :key="shop.id">
                            <div class="shop-card">
                                <div v-if="isFavorite(shop.id) == true">
                                    <div class="shop-photo">
                                        <img
                                            :src="shop.photo"
                                            alt="イメージ画像"
                                        />
                                    </div>
                                    <div class="shop-content">
                                        <div class="shop-name">
                                            {{ shop.name }}
                                        </div>
                                        <div class="tag">
                                            <div class="shop-area">
                                                #{{ shop.area }}
                                            </div>
                                            <div class="shop-genre">
                                                #{{ shop.genre }}
                                            </div>
                                        </div>
                                        <div class="btn">
                                            <div class="detail-btn">
                                                <router-link
                                                    :to="{
                                                        name: 'theshopinfo',
                                                        params: { id: shop.id },
                                                    }"
                                                    class="link"
                                                    >詳しくみる</router-link
                                                >
                                            </div>
                                            <div class="favorite-btn">
                                                <button
                                                    @click="
                                                        deleteFavorite(shop.id)
                                                    "
                                                    type="button"
                                                    value="favorite"
                                                    class="heart-1"
                                                >
                                                    &hearts;
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <div class="unfavorite"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            user: [],
            shops: [],
            favorites: [],
            reservations: [],
        };
    },
    methods: {
        async deleteFavorite(shopId) {
            const favorite = this.favorites.filter((x) => x.shop_id == shopId);
            await axios.delete(
                `http://localhost:8000/api/v1/favorite/${favorite[0].id}`
            );
            const newFavorite = await axios.get(
                "http://localhost:8000/api/v1/favorite"
            );
            const favoriteData = newFavorite.data;
            this.favorites = favoriteData.data;
        },
        isFavorite(shopId) {
            const favorite = this.favorites.filter((x) => x.shop_id == shopId);
            return favorite.length != 0;
        },
        shopName(shopId) {
            const shop = this.shops.filter((x) => x.id == shopId);
            return shop[0].name;
        },
        async deleteReserve(reserveId) {
            await axios.delete(
                `http://localhost:8000/api/v1/reservation/${reserveId}`
            );
            const newReservation = await axios.get(
                "http://localhost:8000/api/v1/reservation"
            );
            const reservationData = newReservation.data;
            this.reservations = reservationData.data;
            console.log(reserveId);
        },
        menu() {
            this.$router.push("/menu");
        },
    },
    async mounted() {
        const item = await axios.get("http://localhost:8000/api/v1/shop");
        const shopData = item.data;
        this.shops = shopData.data;
        const favorite = await axios.get(
            "http://localhost:8000/api/v1/favorite"
        );
        const favoriteData = favorite.data;
        this.favorites = favoriteData.data;

        const reservation = await axios.get(
            "http://localhost:8000/api/v1/reservation"
        );
        const reservationData = reservation.data;
        this.reservations = reservationData.data;
        const loginUser = await axios.get("http://localhost:8000/api/v1/user");
        const userData = loginUser.data;
        this.user = userData.data;
    },
    computed: {
        getFavoriteShops() {
            return this.shops.filter((x) => this.isFavorite(x.id));
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

.reservation {
    padding-top: 100px;
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
.all {
    background-color: #ebebeb;
}

.left_reserve {
    padding: 30px;
    margin-top: 40px;
}

.reserve-card {
    width: 330px;
    border-radius: 5px;
    margin: 15px 5px;
    box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);
    background-color: #077af2;
    color: white;
    padding: 15px 15px;
}

.reserve-name {
    padding-top: 3px;
}

.reserve-ttl {
    display: flex;
    justify-content: space-between;
    padding: 10px 10px;
}

.reserve {
    font-size: 20px;
    font-weight: 600;
}

th,
td {
    padding: 7px 0;
    font-weight: normal;
}

td {
    padding-left: 10px;
}

th {
    text-align: left;
}

.login-name {
    font-size: 24px;
    font-weight: bold;
}
.cancel-btn {
    font-size: 17px;
    font-weight: bold;
    border-radius: 50%;
    border: solid 2px;
    border-color: white;
    padding: 3px 3px 5px 3px;
}

.unfavorite {
    display: none;
}
.mypage {
    width: 65%;
}
.favorite-shop {
    display: flex;
    flex-wrap: wrap;
}

.favorite-tytle {
    padding-top: 45px;
    font-size: 20px;
    font-weight: 600;
}

.shop-card {
    width: 260px;
    border-radius: 5px;
    margin: 15px 20px;
    box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);
}

.shop-photo img {
    width: 100%;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.shop-content {
    padding: 15px 25px;
    background-color: white;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}

.shop-name {
    font-size: 15px;
    font-weight: bold;
    margin: 10px 0;
}

.tag {
    display: flex;
}

.detail-btn {
    background-color: #006cd9;
    width: 60px;
    padding: 8px 12px;
    border-radius: 5px;
    margin: 15px 0;
}

.link {
    text-decoration: none;
    color: white;
}
.heart-1 {
    color: red;
    font-size: 24px;
    border: none;
    background: transparent;
    transform: scaleX(1.5);
    margin: 15px 0;
}

.btn {
    display: flex;
    justify-content: space-between;
}
</style>
