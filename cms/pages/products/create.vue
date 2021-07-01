<template>
    
    <div class="d-flex flex-column-fluid" id="dev-appliance-list">

        <!-- Modal -->
        <div class="modal fade secondaryImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Imagen secundaria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Imagen</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Subir archivo</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" @change="onSecondaryImageChange"  accept="image/*">
                                    <label class="custom-file-label" for="inputGroupFile01">Elegir archivo</label>
                                </div>
                            </div>
                           
                        </div>

                    </div>
                    <img :src="imageSecondaryPreview" class="w-100">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="uploadSecondaryImage()">Añadir</button>
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
                        <h3 class="card-label">Crear producto</h3>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div class="container-fluid mt-6 mb-6" >
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" class="form-control" v-model="name">
                                    <ErrorShow :error="errors" :name="'name'"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Marca</label>
                                    <select class="form-control" v-model="brandId">
                                        <option value="">Seleccione</option>
                                        <option v-for="brand in brands" :value="brand.id" v-bind:key="brand.id">{{ brand.name }}</option>
                                    </select>
                                    <ErrorShow :error="errors" :name="'brandId'"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Categoría</label>
                                    <select class="form-control" v-model="categoryId">
                                        <option value="">Seleccione</option>
                                        <option v-for="category in categories" :value="category.id" v-bind:key="category.id">{{ category.name }}</option>
                                    </select>
                                    <ErrorShow :error="errors" :name="'categoryId'"/>
                                </div>
                            </div>

                            <div class="col-md-4">
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
                                <p class="text-center" v-if="imagePreview && finalPictureName == ''">
                                    <button class="btn btn-info" @click="uploadImage()">Subir imagen</button>
                                </p>

                                <div v-if="pictureStatus == 'subiendo'" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${imageProgress}%`}">
                                    {{ imageProgress }}%
                                </div>
                                
                                <p v-if="pictureStatus == 'subiendo' && imageProgress < 100">Subiendo</p>
                                <p v-if="pictureStatus == 'subiendo' && imageProgress == 100">Espere un momento</p>
                                <p v-if="pictureStatus == 'listo' && imageProgress == 100">Imágen lista</p>
                            </div>

                            <div class="col-md-12">
                                <client-only placeholder="loading...">
                                    <ckeditor-nuxt v-model="description" :config="editorConfig"  />
                                    <ErrorShow :error="errors" :name="'description'"/>
                                </client-only>

                            </div>

                            <div class="col-md-12">

                                <h3 class="text-center">Variaciones</h3>
                                <ErrorShow :error="errors" :name="'variations'"/>
                            </div>



                            <div class="col-md-4">
                               
                                <div class="form-group">
                                    <label for="">Precio</label>
                                    <input type="text" class="form-control" v-model="price" @keypress="isNumber($event)">
                                </div>
                              
                            </div>

                            <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label for="">Tamaño</label>
                                    <select class="form-control" v-model="size">
                                        <option value="">Seleccione</option>
                                        <option :value="size" v-for="size in sizes" v-bind:key="size.id">{{ size.name }} - {{ size.gender }}</option>
                                    </select>
                                </div>
                                
                            </div>

                            <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label for="">Cantidad</label>
                                    <input type="text" class="form-control" v-model="amount" @keypress="isNumber($event)">
                                </div>
                                
                            </div>

                            <div class="col-md-12">
                                <p class="text-center">
                                    <button class="btn btn-info" @click="addVariation()">Añadir variación</button>
                                </p>
                            </div>

                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Precio</th>
                                            <th>Tamaño</th>
                                            <th>Cantidad</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(variation, index) in variations" v-bind:key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                {{ variation.price }}
                                            </td>
                                            <td>
                                                {{ variation.size }} - {{ variation.gender }}
                                            </td>
                                            <td>
                                                {{ variation.amount }}
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" @click="popVariation(index)">
                                                    <fa icon="trash-alt" class="mr-1"></fa>
                                                </button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12">

                                <h3 class="text-center">Imagenes secundarias</h3>

                            </div>

                            <div class="col-md-12 mt-4 mb-4">
                                <p class="text-center">
                                    <button class="btn btn-info" data-toggle="modal" data-target=".secondaryImageModal">Añadir imágenes secundarias</button>
                                </p>

                            </div>

                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Porcentaje</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(secondaryImage, index) in secondaryImages" v-bind:key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <img :src="secondaryImage.preview" alt="" style="width: 200px;">
                                            </td>
                                            <td>
                                                <div v-if="secondaryImage.status == 'subiendo'" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${secondaryImage.progress}%`}">
                                                    {{ secondaryImage.progress }}%
                                                </div>
                                                
                                                <p v-if="secondaryImage.status == 'subiendo' && secondaryImage.progress < 100">Subiendo</p>
                                                <p v-if="secondaryImage.status == 'subiendo' && secondaryImage.progress == 100">Espere un momento</p>
                                                <p v-if="secondaryImage.status == 'listo' && secondaryImage.progress == 100">Imágen lista</p>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" @click="popImage(index)">
                                                    <fa icon="trash-alt" class="mr-1"></fa>
                                                </button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                         
                            <div class="col-md-12">
                                <p class="text-center">
                                    <button class="btn btn-primary" v-if="!onLoadingStore" @click="store()">Crear producto</button>
                                    <button class="btn btn-primary spinner spinner-white spinner-right" v-else>Loading</button>
                                </p>
                            </div>

                        

                        </div>

                    </div>
                    
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

    export default {    
        name:"Create",
        data(){
            return{
                name:"",
                price:"",
                mainImage:"",
                description:"",
                categoryId:"",
                brandId:"",
                categories:[],
                brands:[],
                sizes:[],
                size:"",
                onLoadingStore:false,
                imageProgress:0,
                pictureStatus:"",
                imagePreview:"",
                finalPictureName:"",
                image:"",
                file:null,
                errors:[],
                secondaryImages:[],
                imageSecondaryPreview:"",
                secondaryFile:null,
                editorConfig: {
                    removePlugins: ['ImageInsert'],
                },
                variations:[],
                amount:1
                
            }
        },
        components: {
            'ckeditor-nuxt': () => { if (process.client) { return import('@blowstack/ckeditor-nuxt') } },
        },
        methods:{
            
            async fetchBrands(){

                let res = await this.$axios.get("/admin/brands/fetch")
                this.brands = res.data.brands

            },
            async fetchCategories(){

                let res = await this.$axios.get("/admin/categories/fetch")
                this.categories = res.data.categories

            },
            async fetchSizes(){

                let res = await this.$axios.get("/admin/sizes/fetch")
                this.sizes = res.data.sizes

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

            },
            onSecondaryImageChange(e){
                let picture = e.target.files[0];

                this.imageSecondaryPreview = URL.createObjectURL(picture);

                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                if(files[0]['type'].split('/')[0] == "image"){
                    this.secondaryFile = files[0]

                }else{
                    this.$swal({
                        text:"Debe seleccionar un archivo de imagen",
                        icon:"error"
                    })
                    this.imageSecondaryPreview = ""
                }
                
            },
            popImage(index){
                this.secondaryImages.splice(index, 1)
            },
            async uploadSecondaryImage(){
                
                this.secondaryImages.push({status: "subiendo", preview:this.imageSecondaryPreview, originalName:this.secondaryFile.name.toLowerCase(), finalName:"", progress:0})

                this.secondaryPicture = ""
                this.imageSecondaryPreview = ""

                if(this.secondaryFile != null){
                
                    let formData = new FormData()
                    formData.append("file", this.secondaryFile)

                    var _this = this
                    var fileName = this.secondaryFile.name.toLowerCase()
                    
                    var config = {
                        headers: { "X-Requested-With": "XMLHttpRequest" },
                        onUploadProgress: function(progressEvent) {
                            
                            var progressPercent = Math.round((progressEvent.loaded * 100.0) / progressEvent.total);

                             if(_this.secondaryImages.length > 0){

                                _this.secondaryImages.forEach((data,index) => {
                                   if(data.originalName.toLowerCase() == fileName){
                                    _this.secondaryImages[index].progress = progressPercent
                                   }

                                })

                            }

                        }
                    }

                    this.$axios.post(
                        "admin/image/store",
                        formData,
                        config                        
                    ).then(res => {
                        this.secondaryImages.forEach((data, index) => {

                            let returnedName = res.data.originalName

                            if(data.originalName.toLowerCase() == returnedName.toLowerCase()){
                                this.secondaryImages[index].status = "listo";
                                this.secondaryImages[index].finalName = res.data.fileRoute
                            }

                        })

                    }).catch(err => {
                        console.log(err)
                    })

  
                }

            },
            isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            },
            addVariation(){

                if(this.size == "" || this.price == "" || this.amount == "" || this.amount < 1){

                    this.$swal({
                        text:"Debes elegir un tamaño, una cantidad y un precio",
                        icon:"error"
                    })
                    
                    return false
                }

                this.variations.push({
                    sizeId:this.size.id,
                    size: this.size.name,
                    gender: this.size.gender,
                    price: this.price,
                    amount: this.amount
                })

                this.size = ""
                this.price = ""
                this.amount = 1

            },
            popVariation(index){
                this.variations.splice(index, 1)
            },
            async store(){

                if(this.finalPictureName == ""){
                    this.$swal({
                        text:"Debes agregar una image principal",
                        icon:"error"
                    })

                    return false
                }

                this.onLoadingStore = true
                this.errors = []
                try{

                    let res = await this.$axios.post("/admin/products/store", {
                        "name": this.name,
                        "brandId": this.brandId,
                        "categoryId": this.categoryId,
                        "image": this.finalPictureName,
                        "variations": this.variations,
                        "secondaryImages": this.secondaryImages,
                        "description": this.description
                    })

                    if(res.data.success == true){

                        this.$swal({
                            text:res.data.msg,
                            icon:"success"
                        }).then(ans => {
                            this.$router.push("/products/list")
                        })

                    }else{
                        this.$swal({
                            text:res.data.msg,
                            icon:"error"
                        })
                    }

                }catch(err){
                    
                    if(err.response.data.errors){

                        this.$swal.fire({
                            icon: 'error',
                            text: "Verifica algunos campos",
                            toast: true,
                            position: 'top-end',
                        })

                        this.errors = err.response.data.errors
                    }

                }

                this.onLoadingStore = false

            }
        },
        created(){
            this.fetchBrands()
            this.fetchCategories()
            this.fetchSizes()
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