<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">File Upload Component</div>
                    <div class="card-body">
                       <div class="row">
                          <div class="col-md-3" v-if="image">
                              <img :src="image" class="img-responsive" height="70" width="90">
                           </div>
                          <div class="col-md-6">
                              <input type="file" v-on:change="onImageChange" class="form-control">
                          </div>
                          <div class="col-md-3">
                             <button class="btn btn-success btn-block" @click="uploadImage">Upload Image</button>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                image: ''
            }
        },
        methods: {
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadImage(){
                console.log(this.image);
                axios.post('/image/store',{image: this.image}).then(response => {
                   console.log(response);
                });
            }
        }
    }
</script>

<!-- <template>
  <div class="panel-body" id="app">
    <input type="file" id="fileInput" ref = "fileInput" />
    <input type="button" name="button" value="save" @click="submitform()">
  </div>
</template>

<script>
  export default {
    /*
      Defines the data used by the component
    */
    data(){
      return {
        file: ''
      }
    },

    methods: {
      submitform() {
        var formData = new FormData();
        formData.append('id', '1');
        formData.append('image', this.$refs.fileInput.files[0]);
        console.log(formData)
        axios.post('/image/store', formData).then( response => {
                            console.log(response);
        } ).catch((error) => {
                   console.error(error);
              });
      }
    }
  }
</script> -->