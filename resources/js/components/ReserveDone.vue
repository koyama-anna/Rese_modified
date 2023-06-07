<template>
  <div class="all">
    <div class="center">
      <h1 class="header-logo">Rese</h1>
    </div>
    <div class="thanks-card">
      <div class="card">
        <div class="thanks">ご予約ありがとうございます</div>
        <div class="back">
          <button @click="$router.go(-1)" class="back-btn">戻る</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script></script>
<style scoped>
.header-logo {
  height: 70px;
  line-height: 70px;
  color: #0080ff;
}

.all {
  background-color: #ebebeb;
}
.thanks-card {
  display: flex;
  justify-content: center;
}
.card {
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 350px;
  text-align: center;
  box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2);
}

.thanks {
  font-size: 18px;
  margin-top: 60px;
  margin-bottom: 40px;
}

.back {
  background-color: #006cd9;
  width: 50px;
  padding: 5px 10px;
  border-radius: 5px;
  margin: 15px auto;
  margin-top: 15px;
  margin-bottom: 60px;
}

.back-btn {
  border: none;
  background: transparent;
  color: white;
  font-size: 14px;
}
</style>
