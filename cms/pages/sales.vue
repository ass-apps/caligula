<template>
    
    <div class="d-flex flex-column-fluid" id="dev-appliance-list">

        <modal :sale="sale"></modal>


        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Ventas</h3>
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
                                    <td>N° compra</td>
                                    <td>Nombre</td>
                                    <td>Apellido</td>
                                    <td>Email</td>
                                    <td>Dirección</td>
                                    <td>Teléfono</td>
                                    <td>Total</td>
                                    <td>Fecha</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="sale in sales" v-bind:key="sale.id">
                                    <td>{{ sale.order_id }}</td>
                                    <td>{{ sale.name }}</td>
                                    <td>{{ sale.lastname }}</td>
                                    <td>{{ sale.email }}</td>
                                    <td>{{ sale.address }}</td>
                                    <td>{{ sale.phone }}</td>
                                    <td>{{ sale.total }}</td>
                                    <td>{{ sale.created_at.substring(0, 10) }}</td>
                                   
                                    <td>
                                        <button class="btn btn-info" @click="setProducts(sale)" data-toggle="modal" data-target=".saleModal">
                                            <fa icon="eye"></fa>
                                        </button>
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

    import modal from '../components/sales/modal.vue'

    export default {    
        name:"Brands",
        data(){
            return{
                pages:1,
                page:1,
                imageProgress:0,
                pictureStatus:"",
                sales:[],
                sale:"",
                onLoadingFetch:false
            }
        },
        components:{modal},
        methods:{
            
            async fetch(page){

                this.page = page

                this.onLoadingFetch = true
                let res = await this.$axios.get("/admin/purchases/fetch/"+this.page)
                this.sales = res.data.purchases
                this.onLoadingFetch = false
            },
            setProducts(product){
      
                this.sale = product.purchased_variations
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