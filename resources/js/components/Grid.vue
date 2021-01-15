<template>
  <table border="1">
    <thead>
      <tr>
        <th>Country</th>
        <th>Capital</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="country in countryList">
        <td>
          <input type="text" name="countryName" v-model="country.country" />
        </td>
        <td>
          <input type="text" name="countryCapital" v-model="country.capital" />
        </td>
        <td>
          <input v-on:click="handleDelete(country)" type="button" name="delete" value="Delete" />
        </td>
      </tr>
      <tr colspan="3">
        <input v-on:click="handleAdd" type="button" name="add" value="Add" />
      </tr>
    </tbody>
  </table>
</template>

<script type="text/javascript">
 export default {
     props: ["countryList"],
     methods: {
         handleDelete : function(country) {
             this.$delete(this.countryList, this.countryList.indexOf(country));
         },
         handleAdd : function(e) {
             this.countryList.push({ country : "", capital : ""});
         }
     }
 }
</script>
