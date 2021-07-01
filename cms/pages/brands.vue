<template>
    
    <div class="d-flex flex-column-fluid" id="dev-appliance-list">

        <!-- Modal -->
        <div class="modal fade adminBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Añadir Marca</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="container-fluid">
                           <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">Marca</label>
                                            <input type="text" class="form-control" v-model="brand">
                                            <ErrorShow :error="errors" :name="'name'"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">Imagen</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupFileAddon01">Subir archivo</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" @change="onImageChange"  accept="image/*">
                                                    <label class="custom-file-label" for="inputGroupFile01">Elegir archivo</label>
                                                </div>
                                            </div>
                                            <ErrorShow :error="errors" :name="'image'"/>
                                        </div>

                                    </div>
                                    <img :src="imagePreview" class="w-100">

                                    <div v-if="pictureStatus == 'subiendo'" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${imageProgress}%`}">
                                        {{ imageProgress }}%
                                    </div>
                                    
                                    <p v-if="pictureStatus == 'subiendo' && imageProgress < 100">Subiendo</p>
                                    <p v-if="pictureStatus == 'subiendo' && imageProgress == 100">Espere un momento</p>
                                    <p v-if="pictureStatus == 'listo' && imageProgress == 100">Imágen lista</p>


                                </div>

                           </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cerrar</button>
                        <button class="btn btn-primary" v-if="action == 'create' && onLoadingStore == false" @click="store()">Añadir</button>
                        <button class="btn btn-primary spinner spinner-white spinner-right" v-if="onLoadingStore == true">Guardando</button>
                        <button class="btn btn-primary" v-if="action == 'edit' && onLoadingUpdate == false" @click="update()">Actualizar</button>
                        <button class="btn btn-primary spinner spinner-white spinner-right" v-if="onLoadingUpdate == true">Actualizando</button>
                    </div>
                </div>
            </div>
        </div>

        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Marcas</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <button class="btn btn-primary" data-toggle="modal" data-target=".adminBrandModal" @click="create()">Añadir marca</button>
                        <!--end::Dropdown-->
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div class="container-fluid mt-6 mb-6" v-if="onLoadingFetch == true">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-center">
                                
                                    <div class="spinner spinner-primary spinner-lg mr-15"></div>
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable" style="">
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Nombre</td>
                                    <td>Imagen</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="brand in brands" v-bind:key="brand.id">
                                    <td>{{ brand.name }}</td>
                                    <td>
                                        <img :src="brand.image" style="width: 200px;">
                                    </td>
                                    <td>
                                        <button @click="edit(brand)" class="btn btn-info" data-toggle="modal" data-target=".adminBrandModal">ver</button>
                                        <button @click="remove(brand.id)" class="btn btn-danger">eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    
                    </div>
                    <!--end: Datatable-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->

                </div>

            </div>
        </div>
        <!--end::Container-->

    </div>

</template>

<script>

    import ErrorShow from '../components/ErrorShow';

    export default {    
        name:"Brands",
        components:{ErrorShow},
        data(){
            return{
                imageProgress:0,
                pictureStatus:"",
                brands:[],
                errors:[],
                action:"create",
                brand:"",
                imagePreview:"",
                brandId:"",
                image:"",
                file:null,
                finalPictureName:"",
                onLoadingStore:false,
                onLoadingUpdate:false,
                onLoadingFetch:false
            }
        },
        methods:{
            create(){

                this.action = "create"
                this.brand = ""
                this.image = ""
                this.imagePreview = ""
                this.file = null
                this.imageProgress = 0
                this.pictureStatus = ""

            },
            edit(brand){

                this.action = "edit"
                this.brand = brand.name
                this.imagePreview = brand.image
                this.brandId = brand.id

            },
            onImageChange(e){
                let picture = e.target.files[0];

                this.imagePreview = URL.createObjectURL(picture);

                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                if(files[0]['type'].split('/')[0] == "image"){
                    this.file = files[0]
                }else{
                    this.$swal({
                        text:"Debe seleccionar un archivo de imagen",
                        icon:"error"
                    })
                    this.imagePreview = ""
                }
                
            },
            async store(){
                
                if(this.imagePreview != ""){
                    
                    if(this.brand != ""){
                        await this.uploadImage()
                    }else{
                        this.$swal({
                            text:"Debe añadir un nombre",
                            icon:"error"
                        })
                    }

                }else{
                    this.$swal({
                        text:"Debe seleccionar una imagen",
                        icon:"error"
                    })
                }

            },
            async update(){

                if(this.brand != ""){
                    await this.uploadImage()
                }else{
                    this.$swal({
                        text:"Debe añadir un nombre",
                        icon:"error"
                    })
                }                

            },
            async sendData(){
                
                if(this.action == "create"){
                    this.onLoadingStore = true
                }else{
                    this.onLoadingUpdate = true
                }  

                try{    

                    let form = new FormData()
                    form.append("name", this.brand)
                    form.append("image", this.finalPictureName)

                    let res = await this.$axios.post("/admin/brands/store", form)
                    if(this.action == "create"){
                        this.onLoadingStore = false
                    }else{
                        this.onLoadingUpdate = false
                    }  

                    if(res.data.success == true){

                        this.$swal({
                            icon: 'success',
                            text: res.data.msg,
                        }).then(ans => {

                            $('.adminBrandModal').modal('hide')
                            $('.modal-backdrop').remove()

                            this.brand = ""
                            this.imageProgress = ""
                            this.pictureStatus = ""

                            this.fetch()

                        })

                    }else{
                        this.$swal({
                            icon: 'error',
                            text: res.data.msg,
                        })
                    }

                }catch(err){
                    
                    if(this.action == "create"){
                        this.onLoadingStore = false
                    }else{
                        this.onLoadingUpdate = false
                    }  
                    if(err.response.data.error){
                        
                        this.$swal({
                            icon: 'error',
                            text: err.response.data.error,
                        })
                    }
                    if(err.response.data.errors){

                        this.$swal({
                            icon: 'error',
                            text: "Hay algunos campos que debes revisar",
                            toast: true,
                            position: 'top-end',
                        })

                        this.errors = err.response.data.errors
                    }

                }

                if(this.action == "create"){
                    this.onLoadingStore = false
                }else{
                    this.onLoadingUpdate = false
                }  

            },
            async sendUpdateData(){
                
               
                this.onLoadingUpdate = true
                 

                try{    

                    let form = new FormData()
                    form.append("id", this.brandId)
                    form.append("name", this.brand)
                    form.append("image", this.finalPictureName)

                    let res = await this.$axios.post("/admin/brands/update", form)
                    this.onLoadingUpdate = false
                     

                    if(res.data.success == true){

                        this.$swal({
                            icon: 'success',
                            text: res.data.msg,
                        }).then(ans => {

                            $('.adminBrandModal').modal('hide')
                            $('.modal-backdrop').remove()

                            this.brand = ""
                            this.imageProgress = ""
                            this.pictureStatus = ""

                            this.fetch()

                        })

                    }else{
                        this.$swal({
                            icon: 'error',
                            text: res.data.msg,
                        })
                    }

                }catch(err){
                    
                    this.onLoadingUpdate = false
                  
                    if(err.response.data.error){
                        
                        this.$swal({
                            icon: 'error',
                            text: err.response.data.error,
                        })
                    }
                    if(err.response.data.errors){

                        this.$swal({
                            icon: 'error',
                            text: "Hay algunos campos que debes revisar",
                            toast: true,
                            position: 'top-end',
                        })

                        this.errors = err.response.data.errors
                    }

                }

                this.onLoadingUpdate = false
                

            },
            async uploadImage(){
                if(this.action == "create"){
                    this.onLoadingStore = true
                }else{
                    this.onLoadingUpdate = true
                }   
                
                if(this.file != null){
                    this.imageProgress = 0;
                
                    let formData = new FormData()
                    formData.append("file", this.file)

                    var _this = this
                    this.pictureStatus = "subiendo";
                    
                    var config = {
                        headers: { "X-Requested-With": "XMLHttpRequest" },
                        onUploadProgress: function(progressEvent) {
                            
                            var progressPercent = Math.round((progressEvent.loaded * 100.0) / progressEvent.total);
                        
                            _this.imageProgress = progressPercent
                        
                            
                        }
                    }

                    let res = await this.$axios.post("admin/image/store", formData, config)
                    this.pictureStatus = "listo";
                    this.finalPictureName = res.data.fileRoute

                    this.onLoadingStore = false
                }
                

                if(this.action == "create"){
                    this.sendData()
                }else{
                    this.sendUpdateData()
                }  
                

            },
            
            async fetch(){
                this.onLoadingFetch = true
                let res = await this.$axios.get("/admin/brands/fetch")
                this.brands = res.data.brands
                this.onLoadingFetch = false
            },
            async remove(id){

                this.$swal.fire({
                    title: '¿Deseas eliminar esta marca?',
                    showDenyButton: true,
                    confirmButtonText: `Sí, eliminar`,
                    denyButtonText: `No`,
                }).then((result) => {
                
                    if (result.isConfirmed) {

                        this.erase(id)
                        
                    }
                })

            },
            async erase(id){
                this.onLoadingFetch = true
                let res = await this.$axios.post("/admin/brands/delete", {id: id});
                this.onLoadingFetch = false
                if(res.data.success == true){
                    this.$swal.fire(res.data.msg, '', 'success')

                    this.fetch()

                }else{
                    this.$swal.fire(res.data.msg, '', 'error')
                }
            }
        },
        created(){
            this.fetch()
        }

    }

</script>

<style>
    .content{
        margin-left: 0px;
    }

    .row{
        width: 100%;
    }
</style>