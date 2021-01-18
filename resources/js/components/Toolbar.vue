<template>
  <div class="row">
    <div class="col-md-7">
      <form method="POST" action="" class="row">
        <label for="fileToUpload" class="col-md-3">Select file</label>
        <input class="col-md-9" v-on:change="handleUpload" type="file" ref="fileToUpload" name="fileToUpload" value="" />
      </form>
    </div>

    <div class="col-md-5">
      <form method="POST" action="">
        <label for="fileFormat">File format</label>
        <select name="fileFormat" ref="format">
          <option v-for="fileType in fileTypes">{{fileType}}</option>
        </select>
        <input v-on:click="handleDownload" type="submit" name="fileToDownload" value="Download" />
      </form>
    </div>
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
