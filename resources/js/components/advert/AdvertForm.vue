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
        id="photosGroup"
        label="Kuvat:"
        label-for="photos"
        description="Kiekon kuvat (jpg, png tai gif)">            

      <template>
        <b-form-file
          id="photos"
          multiple
          accept="image/jpeg, image/png, image/gif"
          v-model="form.photos"
          :state="Boolean(form.photos)"
          placeholder="Lisää kuvat..."
          drop-placeholder="Pudota kuvat tähän..."
        ></b-form-file>
        </template>
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
          photos: []
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
      }
    },
    methods: {
      onSubmit() {
        console.log(JSON.stringify(this.form));
        if (this.edit) {
          console.log('Tallennetaan muutokset');
        } else {
          console.log('Tallennetaan uusi ilmoitus');
          fetch('api/ilmoitus', {
            method: 'post',
            body: JSON.stringify(this.form),
            headers: {
              'Content-Type' : 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            this.onReset();
            console.log('Ilmoitus jätetty');
          })
          .catch(err => console.log(err));
        }
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
