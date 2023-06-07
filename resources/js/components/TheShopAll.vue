<template>
  <div class="all">
    <div class="header">
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
      <div class="search">
        <select name="area" v-model="search_area" class="search_area">
          <option value="" selected>All area</option>
          <option value="東京都">東京都</option>
          <option value="福岡県">福岡県</option>
          <option value="大阪府">大阪府</option>
        </select>
        <select name="genre" v-model="search_genre" class="search_genre">
          <option value="" selected>All genre</option>
          <option value="寿司">寿司</option>
          <option value="焼肉">焼肉</option>
          <option value="居酒屋">居酒屋</option>
          <option value="イタリアン">イタリアン</option>
          <option value="ラーメン">ラーメン</option>
        </select>
        <input
          v-model="search_name"
          class="search_name"
          placeholder="Search ..."
        />
      </div>
    </div>
    <div class="home flex">
      <div v-for="shop in shops" :key="shop.id">
        <div class="shop-card">
          <div class="shop-photo">
            <img :src="shop.photo" alt="イメージ画像" />
          </div>
          <div class="shop-content">
            <div class="shop-name">{{ shop.name }}</div>
            <div class="tag">
              <div class="shop-area">#{{ shop.area }}</div>
              <div class="shop-genre">#{{ shop.genre }}</div>
            </div>
            <div class="btn">
              <div class="detail-btn">
                <router-link
                  :to="{ name: 'theshopinfo', params: { id: shop.id } }"
                  class="link"
                  >詳しくみる</router-link
                >
              </div>
              <div class="favorite-btn">
                <div v-if="isFavorite(shop.id) == true">
                  <button
                    @click="deleteFavorite(shop.id)"
                    type="button"
                    value="favorite"
                    class="heart-1"
                  >
                    &hearts;
                  </button>
                </div>
                <div v-else>
                  <button
                    @click="toggleFavorite(shop.id)"
                    type="button"
                    value="favorite"
                    class="heart-2"
                  >
                    &hearts;
                  </button>
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
      shops: [],
      favorites: [],
      search_area: "",
      search_genre: "",
      search_name: "",
    };
  },
  methods: {
    async toggleFavorite(shopId) {
      await axios.post("http://localhost:8000/api/v1/favorite", {
        shop_id: shopId,
      });

      const favorite = await axios.get("http://localhost:8000/api/v1/favorite");
      const favoriteData = favorite.data;
      this.favorites = favoriteData.data;
    },
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
    async filteredsearch(shopArea, shopGenre, shopName) {
      const item = await axios.get("http://localhost:8000/api/v1/shop", {
        params: {
          area: shopArea,
          genre: shopGenre,
          name: shopName,
        },
      });
      console.log(item);
      const shopData = item.data;
      this.shops = shopData.data;
    },
    menu() {
      this.$router.push("/menu");
    },
  },
  async mounted() {
    const item = await axios.get("http://localhost:8000/api/v1/shop");
    const shopData = item.data;
    this.shops = shopData.data;
    const favorite = await axios.get("http://localhost:8000/api/v1/favorite");
    const favoriteData = favorite.data;
    this.favorites = favoriteData.data;
  },
  watch: {
    search_area(newArea) {
      this.filteredsearch(newArea, this.search_genre, this.search_name);
    },
    search_genre(newGenre) {
      this.filteredsearch(this.search_area, newGenre, this.search_name);
    },
    search_name(newName) {
      this.filteredsearch(this.search_area, this.search_genre, newName);
    },
  },
};
</script>

<style scoped>
.all {
  background-color: #ebebeb;
}

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

.search {
  margin: 30px;
  box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);
}

.search_area,
.search_genre,
.search_name {
  font-size: 14px;
  border: none;
  height: 35px;
  box-sizing: content-box;
}

.search_area,
search_genre {
  padding-left: 15px;
}

.search_area {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

.search_name {
  width: 250px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}

.shop-card {
  width: 260px;
  border-radius: 5px;
  margin: 15px 5px;
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

.heart-2 {
  color: #ebebeb;
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
