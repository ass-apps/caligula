<template>
    
    <div class="modal fade saleModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Producto</td>
                                <td>Cantidad</td>
                                <td>Precio</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr v-for="(info, index) in sale" :key="'info-'+index">
                                <td>{{ info.variation.product.brand.name }} {{ info.variation.product.name }}</td>
                                <td>{{ info.amount }}</td>
                                <td>{{ info.price }}</td>
                            </tr>   

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    
    props:["sale"]

}
</script>