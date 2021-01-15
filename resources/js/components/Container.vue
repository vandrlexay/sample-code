<template>
  <div>
    <Grid v-bind:countryList="countryList"/>
    <Toolbar
        v-on:countryListChange="handleCountryListChange"
        v-on:fileUpload="handleFileUpload"
        v-on:fileDownload="handleFileDownload"
        v-bind:route="route"
        v-bind:countryList="countryList"
    />
  </div>
</template>

<script>
 export default {
     props: ["countryList", "route"],
     methods : {
         handleCountryListChange : function(value) { this.$emit("countryListChange", value); },
         handleFileUpload        : function(value) { this.$emit("fileUpload", value); },
         handleFileDownload      : function(value) { this.$emit("fileDownload", value); }
     }
 }
</script>
