<template>
  <div class="justify-content-center">
    <h2>Upload</h2>
    <form method="POST" action="">
      <input v-on:change="handleUpload" type="file" ref="fileToUpload" name="fileToUpload" value="" />
    </form>

    <h2>Save</h2>
    <form method="POST" action="">
      <label for="fileFormat">File format</label>
      <select name="fileFormat" ref="format">
        <option v-for="fileType in fileTypes">{{fileType}}</option>
      </select>
      <input v-on:click="handleDownload" type="submit" name="fileToDownload" value="Download" />
    </form>
  </div>
</template>

<script type="text/javascript">
 export default {
     props: [ "route", "countryList", "fileTypes" ],
     methods : {
         handleDownload : function(e) {
             e.preventDefault();
             this.$emit("fileDownload", this.$refs.format.value);
         },
         handleUpload : function(e) {
             e.preventDefault();

             const formData = new FormData();
             formData.append("fileToUpload", this.$refs.fileToUpload.files[0]);

             this.$emit("fileUpload", formData);
         }
     }
 };

</script>
