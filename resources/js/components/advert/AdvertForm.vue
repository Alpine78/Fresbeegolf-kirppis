<template>
  <div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">

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
        <b-form-select id="type" :options="discs" required v-model="form.type" />
      </b-form-group>

      <b-form-group id="conditionGroup" label="Kunto:" label-for="condition">
        <b-form-select id="condition" :options="conditions" required v-model="form.condition" />
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
          title: '',
          content: '',
          brand: '',
          model: '',
          type: null,
          condition: null,
          price: ''
        },
        discs: [{ text: 'Valitse yksi', value: null }, 'Putteri', 'Midari', 'Väylädriveri', 'Driveri', 'Pituusdriveri'],
        conditions: [{ text: 'Valitse yksi', value: null }, 'Uusi', 'Uudenveroinen', 'Hyvä', 'Tyydyttävä', 'Huono'],
        show: true
      }
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()
        alert(JSON.stringify(this.form))
      },
      onReset(evt) {
        evt.preventDefault()
        /* Reset our form values */
        this.form.title = ''
        this.form.content = ''
        this.form.brand = ''
        this.form.model = ''
        this.form.type = null
        this.form.condition = null
        this.form.price = ''
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
