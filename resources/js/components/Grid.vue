<template>
  <table border="1">
    <thead>
      <tr>
        <th>Country</th>
        <th>Capital</th>
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
      </tr>
    </tbody>
  </table>
</template>

<script type="text/javascript">
 export default {
     props: ["countryList"]
 }
</script>
