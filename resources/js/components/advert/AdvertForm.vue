<template>
  <div>
    <b-form @submit.prevent="onSubmit" @reset.prevent="onReset" v-if="show">

      <b-form-group
        id="titleGroup"
        label="Ilmoituksen otsikko:"
        label-for="title"
        description="Anna ilmoitukselle kuvaava otsikko."
      >
        <b-form-input
          id="title"
          type="text"
          v-model="form.title"
          required
          placeholder="Kirjoita otsikko" />
      </b-form-group>

      <b-form-group
        id="brandGroup"
        label="Merkki:"
        label-for="brand"
        description="Kiekon merkki"
      >
        <b-form-input
          id="brand"
          type="text"
          v-model="form.brand"
          required
          placeholder="Kirjoita kiekon merkki" />
      </b-form-group>

      <b-form-group
        id="modelGroup"
        label="Malli:"
        label-for="model"
        description="Kiekon malli"
      >
        <b-form-input
          id="model"
          type="text"
          v-model="form.model"
          required
          placeholder="Kirjoita kiekon malli" />
      </b-form-group>

      <b-form-group id="contentGroup" label="Ilmoituksen sisältö:" label-for="content">
        <b-form-textarea
          id="content"
          rows="3"
          max-rows="6"
          v-model="form.content"
          required
          placeholder="Kirjoita ilmoituksen sisältö" />
      </b-form-group>

      <b-form-group id="typeGroup" label="Tyyppi:" label-for="type">
        <b-form-select id="type" :options="discs" required v-model="form.type">
            <template slot="first">
              <option :value="null" disabled>-- Valitse kiekon tyyppi --</option>
            </template>
        </b-form-select>
      </b-form-group>

      <b-form-group id="conditionGroup" label="Kunto:" label-for="condition">
        <b-form-select id="condition" :options="conditions" required v-model="form.condition">
            <template slot="first">
              <option :value="null" disabled>-- Valitse kuntoluokitus --</option>
            </template>
        </b-form-select>
      </b-form-group>

      <b-form-group
        id="pricedGroup"
        label="Hinta:"
        label-for="price"
        description="Kiekon hinta"
      >
        <b-form-input
          id="price"
          type="number"
          v-model="form.price"
          required
          placeholder="Kirjoita kiekon hinta" />
      </b-form-group>

      <b-form-group
        id="photoGroup"
        label="Kuvat:"
        label-for="photo"
        description="Kiekon kuva (jpg, png tai gif)">            

          <!-- Varalla, jos lisätään paljon kuvia. Ei toimi vielä -->
          <!-- multiple -->
          <!-- v-model="form.photo" -->
      <template>
        <b-form-file
          id="photo"
          required
          accept="image/jpeg, image/png, image/gif"
          :state="Boolean(form.photo)"
          placeholder="Lisää kuva..."
          drop-placeholder="Pudota kuva tähän..."
          @change="fieldChange"
        ></b-form-file>
        </template>
        <b-img v-if="form.photo" :src="form.photo" fluid alt="Responsive image"></b-img>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </div>
</template>

<script>
  export default {
    name: 'AdvertForm',
    data() {
      return {
        form: {
          user_id: 1,
          main_photo_id: 1,
          title: '',
          content: '',
          brand: '',
          model: '',
          type: null,
          condition: null,
          price: '',
          photo: ''
        },
        discs: [
          { text: 'Putteri', value: 1 },
          { text: 'Midari', value: 2 },
          { text: 'Väylädriveri', value: 3 },
          { text: 'Driveri', value: 4 },
          { text: 'Pituusdriveri', value: 5 },
          ],
        conditions: [
          { text: 'Uusi', value: 1 },
          { text: 'Uudenveroinen', value: 2 },
          { text: 'Hyvä', value: 3 },
          { text: 'Tyydyttävä', value: 4 },
          { text: 'Huono', value: 5 },
          ],
        show: true,
        edit: false,
        files: []
      }
    },
    methods: {
      fieldChange(e) {
        var vm = this;
        // this.files = [];
        // // this.files.push(e.target.files);
        // const files = e.target.files;
        // var myphotos = e.target.files;
        // console.log(myphotos);
        
        // myphotos.forEach(photo => {
        //     var file = photo;
        //     var reader = new FileReader();
        //     reader.onloadend = function() {
        //       console.log('RESULT', reader.result)
        //     }
        //     reader.readAsDataURL(file);
        // })


        // // Muutetaan tiedostot base64-muotoon
        // for (var i = 0; i < e.target.files.length; i++) {
        //   // var file = files[fileIndex];
        //   console.log('File ', file);

          console.log(e.target.files[0]);
          let file = e.target.files[0];
          let reader = new FileReader();
          reader.readAsDataURL(file);
          reader.onload = e => {
            console.log(e);
            this.form.photo = e.target.result;
          }
          // reader.onloadend = function() {
          // console.log('Result', reader.result);
          // vm.photo = reader.result;
          // }
          // var temp = reader.readAsDataURL(file);
          // console.log('this.photo ', vm.photo);

        // }

      },
      onSubmit() {
        console.log(JSON.stringify(this.form));
        if (this.edit) {
          console.log('Tallennetaan muutokset');
        } else {
          console.log('Tallennetaan uusi ilmoitus');
          let result = fetch('api/ilmoitus', {
            method: 'post',
            body: JSON.stringify(this.form),
            headers: {
              'Content-Type' : 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            console.log('Ilmoitus jätetty. Yritetään kuvien tallennusta');
            // this.savePhotos(data);
            this.onReset();
            this.$router.push({name: 'frontPage'});
          })
          .catch('Tekstitallennuksen virhe: ', err => console.log(err));
        }
      },
      savePhotos(data) {
        console.log('Tuleeko kuvia? ', this.files);
        console.log('Dataa, advert id? ', data.data.id);

        // let file = this.files[0];
        // let reader = new FileReader();
        // reader.onloadend = function() {
        //   console.log('Result', reader.result);
        // }
        // reader.readAsDataURL(file);

        // Eka viritys
        var fd = new FormData();
        var url = 'api/valokuva';
        for (var photoIndex in this.files) {
          fd.append('photos', this.files[photoIndex]);
        }
        // fd.append('advert_id', data.data.id);
        console.log('Äfdee ', fd);
        fetch(url, {
          method: 'post',
          body: fd
        })
        .then(data => {
          console.log('Kuvat lisättty: ', data);
        })
        .catch('Kuvatallennuksen virhe: ', err => console.log(err));
      },
      onReset() {
        /* Reset our form values */
        this.form.title = ''
        this.form.content = ''
        this.form.brand = ''
        this.form.model = ''
        this.form.type = null
        this.form.condition = null
        this.form.price = ''
        this.form.photos = []
        /* Trick to reset/clear native browser form validation state */
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }
  }
</script>

<style scoped>

</style>
