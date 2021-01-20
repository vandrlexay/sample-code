<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <Grid
            v-bind:countryList="countryList"
            v-on:countryListChange="handleCountryListChange"
        />
      </div>
    </div>
    <hr class="col-md-8"/>
    <div class="row">
      <div class="d-flex justify-content-center">
        <Toolbar
            v-on:countryListChange="handleCountryListChange"
            v-on:fileUpload="handleFileUpload"
            v-on:fileDownload="handleFileDownload"
            v-bind:fileTypes="fileTypes" 
            v-bind:countryList="countryList"
        />
      </div>
    </div>
  </div>
</template>

<script>
 export default {
     props: ["countryList", "route", "fileTypes"],
     methods : {
         handleCountryListChange : function(value) { this.$emit("countryListChange", value); },
         handleFileUpload        : function(value) { this.$emit("fileUpload", value); },
         handleFileDownload      : function(value) { this.$emit("fileDownload", value); }
     }
 }
</script>
