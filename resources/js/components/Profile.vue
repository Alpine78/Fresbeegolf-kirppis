<template>
    <div>
        <div class="row pt-4 justify-content-center">
            <b-alert show variant="info w-75">
                <h3>Muokkaa tietojasi</h3>
                <div v-if="serverErrors">
                    <b-alert v-for="(value, key) in serverErrors" :key="key" show variant="danger">{{ value[0] }}</b-alert>
                </div>

                <div v-if="msg">
                    <b-alert variant="success" show> {{ msg }}</b-alert>
                </div>

                <form action="#" @submit.prevent="updateUserData" >
                    <div class="form-group">
                        <label for="email">Sähköposti</label>
                        <input type="text" id="email" name="email" class="form-control" v-model="email">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Etunimi</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" v-model="firstname">
                    </div>

                    <div class="form-group">
                        <label for="lastname">Sukunimi</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" v-model="lastname">
                    </div>
                    <div class="form-group">
                        <label for="nickname">Käyttäjätunnus</label>
                        <input type="text" id="nickname" name="nickname" class="form-control" v-model="nickname">
                    </div>
                    <div class="form-group">
                        <label for="email">Katuosoite</label>
                        <input type="text" id="address" name="address" class="form-control" v-model="address">
                    </div>
                    <div class="form-group">
                        <label for="zipcode">Postinumero</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control" v-model="zipcode">
                    </div>
                    <div class="form-group">
                        <label for="city">Paikkakunta</label>
                        <input type="text" id="city" name="city" class="form-control" v-model="city">
                    </div>
                    <div class="form-group">
                        <label for="phonenumber">Puhelinnumero</label>
                        <input type="text" id="phonenumber" name="phonenumber" class="form-control" v-model="phonenumber">
                    </div>

                    <button type="submit" class="btn btn-primary">Päivitä tiedot</button>
                </form>
            </b-alert>
        </div>

        <div class="row pt-4 justify-content-center">
            <b-alert show variant="info w-75">
                <h1>Vaihda Salasana</h1>
                <div v-if="msgg">
                    <b-alert variant="success" show> {{ msgg }}</b-alert>
                </div>
                <form action="#" @submit.prevent="changePassword" >
                    <div class="form-group">
                        <label for="currentPassword">Nykyinen salasana</label>
                        <input type="password" id="currentPassword" name="currentPassword" class="form-control" v-model="currentPassword">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Uusi salasana</label>
                        <input type="password" id="newPassword" name="newPassword" class="form-control" v-model="newPassword">
                    </div>
                    <div class="form-group">
                        <label for="confirmationPassword">Vahvista uusi salasana</label>
                        <input type="password" id="confirmationPassword" name="confirmationPassword" class="form-control" v-model="confirmationPassword">
                    </div>

                    <button type="submit" class="btn btn-primary">Päivitä tiedot</button>
                </form>
            </b-alert>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Profile",
        data(){
            return{
                firstname: "",
                lastname: "",
                nickname: "",
                email: "",
                address: "",
                zipcode: "",
                city: "",
                phonenumber: "",
                serverErrors: "",
                msg: "",
                msgg: "",
                currentPassword: "",
                newPassword: "",
                confirmationPassword: "",
            }
        },
        created(){
            this.$store.dispatch('fetchUserData')
                .then(response =>{
                        this.firstname = response.data.firstname,
                        this.lastname = response.data.lastname,
                        this.email = response.data.email,
                        this.nickname = response.data.nickname,
                        this.address = response.data.address,
                        this.zipcode = response.data.zipcode,
                        this.city = response.data.city,
                        this.phonenumber = response.data.phonenumber
                })
        },
        methods: {
          updateUserData(){
              this.$store.dispatch('updateUserData',{
                  firstname: this.firstname,
                  lastname: this.lastname,
                  nickname: this.nickname,
                  address: this.address,
                  zipcode: this.zipcode,
                  city: this.city,
                  phonenumber: this.phonenumber,
              })
                  .then(response => {
                      this.msg = "Tiedot päivitetty"

                  })
                  .catch(error => {
                      this.serverErrors = Object.values(error.response.data.errors)
                      console.log(error.response.data.errors)
              })
            },
            changePassword(){
              if(this.newPassword == this.confirmationPassword){
                  this.$store.dispatch('changePassword',{
                      newPassword: this.newPassword,
                      currentPassword: this.currentPassword,
                  })
                      .then(response => {
                          this.msgg = "Salasana vaihdettu"

                      })
                      .catch(error => {
                          this.msgg = "Salasanan vaihto epäonnistui"
                      })
              }else{
                  this.msg = "Salasanat ei täsmänneet";
              }
            }
        },
    }
</script>

<style scoped>


</style>