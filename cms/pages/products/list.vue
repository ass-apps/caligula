<template>
    
    <div class="d-flex flex-column-fluid" id="dev-appliance-list">

        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Productos</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <NuxtLink :to="{ path: '/products/create'}" class="btn btn-primary">Añadir producto</NuxtLink>
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
                                <tr v-for="product in products" v-bind:key="product.id">
                                    <td>{{ product.name }}</td>
                                    <td>
                                        <img :src="product.mainImage" style="width: 200px;">
                                    </td>
                                    <td>
                                        <div v-if="product.deleted_at == null">
                                            <NuxtLink :to="'/products/'+product.id" class="btn btn-info"><fa icon="edit"></fa></NuxtLink>
                                            <button @click="remove(product.id)" class="btn btn-danger"><fa icon="trash-alt"></fa></button>
                                        </div>
                                        <div v-else>
                                            <button @click="restoreConfirm(product.id)" class="btn btn-info"><fa icon="trash-restore"></fa></button>
                                        </div>
                                        
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

    export default {    
        name:"List",
        data(){
            return{
                products:[],
                page:1,
                pages:1,
                onLoadingFetch:true
                
            }
        },
        methods:{
            
            async fetch(page){
                
                this.page = page

                this.onLoadingFetch = true
                let res = await this.$axios.get("/admin/products/fetch/"+this.page)
                this.products = res.data.products
                this.pages = Math.ceil(res.data.dataAmount / res.data.productsCount)
                this.onLoadingFetch = false
            },
            async remove(id){

                this.$swal.fire({
                    title: '¿Deseas eliminar este producto?',
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
                let res = await this.$axios.post("/admin/products/delete", {id: id});
                this.onLoadingFetch = false
                if(res.data.success == true){
                    this.$swal.fire(res.data.msg, '', 'success')

                    this.fetch(this.page)

                }else{
                    this.$swal.fire(res.data.msg, '', 'error')
                }
            },

            async restoreConfirm(id){

                this.$swal.fire({
                    title: '¿Deseas restaurar este producto?',
                    showDenyButton: true,
                    confirmButtonText: `Sí, restaurar`,
                    denyButtonText: `No`,
                }).then((result) => {
                
                    if (result.isConfirmed) {

                        this.restore(id)
                        
                    }
                })

            },
            async restore(id){
                this.onLoadingFetch = true
                let res = await this.$axios.post("/admin/products/restore", {id: id});
                this.onLoadingFetch = false
                if(res.data.success == true){
                    this.$swal.fire(res.data.msg, '', 'success')

                    this.fetch(this.page)

                }else{
                    this.$swal.fire(res.data.msg, '', 'error')
                }
            }

        },
        created(){
            this.fetch(this.page)
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