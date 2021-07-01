<template>
    
    <div class="d-flex flex-column-fluid" id="dev-appliance-list">

        <!-- Modal -->
        <div class="modal fade adminSizeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Añadir tamaño</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="container-fluid">
                           <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">Tamaño</label>
                                            <input type="text" class="form-control" v-model="size">
                                            <ErrorShow :error="errors" :name="'size'"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">Género</label>
                                            <select class="form-control" v-model="gender">
                                                <option value="femenino">Femenino</option>
                                                <option value="masculino">Masculino</option>
                                            </select>
                                            <ErrorShow :error="errors" :name="'gender'"/>
                                        </div>

                                    </div>
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
                        <h3 class="card-label">Tamaños</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <button class="btn btn-primary" data-toggle="modal" data-target=".adminSizeModal" @click="create()">Añadir tamaño</button>
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
                                    <td>Género</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="size in sizes" v-bind:key="size.id">
                                    <td>{{ size.name }}</td>
                                    <td>{{ size.gender }}</td>
                                    <td>
                                        <button @click="edit(size)" class="btn btn-info" data-toggle="modal" data-target=".adminSizeModal">ver</button>
                                        <button @click="remove(size.id)" class="btn btn-danger">eliminar</button>
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
        name:"Sizes",
        components:{ErrorShow},
        data(){
            return{
                sizes:[],
                errors:[],
                action:"create",
                size:"",
                sizeId:"",
                gender:"femenino",
                onLoadingStore:false,
                onLoadingUpdate:false,
                onLoadingFetch:false
            }
        },
        methods:{
            create(){

                this.action = "create"
                this.size = ""
                this.gender = ""

            },
            edit(size){

                this.action = "edit"
                this.size = size.name
                this.gender = size.gender
                this.sizeId = size.id

            },
            async store(){

                this.errors = []

                let form = new FormData();
                form.append("name", this.size)
                form.append("gender", this.gender)
                this.onLoadingStore = true
                try{

                    let res = await this.$axios.post("/admin/sizes/store", form)
                    this.onLoadingStore = false
                    if(res.data.success == true){

                        this.$swal(
                            {
                                "text": res.data.msg,
                                "icon": "success"
                            }
                        ).then(ans => {
                            $('.adminSizeModal').modal('hide')
                            $('.modal-backdrop').remove()
                            this.fetch()
                        })

                    }else{

                        this.$swal(
                            {
                                "text": res.data.msg,
                                "icon": "error"
                            }
                        )

                    }


                }catch(err){
                    this.onLoadingStore = false
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
            },
            async update(){

                this.errors = []

                let form = new FormData();
                form.append("id", this.sizeId)
                form.append("name", this.size)
                form.append("gender", this.gender)
                this.onLoadingUpdate = true
                try{

                    let res = await this.$axios.post("/admin/sizes/update", form)
                    this.onLoadingUpdate = false
                    if(res.data.success == true){

                        this.$swal(
                            {
                                "text": res.data.msg,
                                "icon": "success"
                            }
                        ).then(ans => {
                            $('.adminSizeModal').modal('hide')
                            $('.modal-backdrop').remove()
                            this.fetch()
                        })

                    }else{

                        this.$swal(
                            {
                                "text": res.data.msg,
                                "icon": "error"
                            }
                        )

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
            },
            async fetch(){
                this.onLoadingFetch = true
                let res = await this.$axios.get("/admin/sizes/fetch")
                this.sizes = res.data.sizes
                this.onLoadingFetch = false
            },
            async remove(id){

                this.$swal.fire({
                    title: '¿Deseas eliminar este tamaño?',
                    showDenyButton: true,
                    confirmButtonText: `Sí, eliminar`,
                    denyButtonText: `No`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        this.erase(id)
                        
                    }
                })

            },
            async erase(id){
                this.onLoadingFetch = true
                let res = await this.$axios.post("/admin/sizes/delete", {id: id});
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