<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Cadastrar Produto</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" v-model="name" class="form-control" id="name" placeholder="Nome do produto">
                            </div>
                            <div class="form-group">
                                <label for="desc">Descrição</label>
                                <input type="text" v-model="desc" class="form-control" id="desc" placeholder="Descrição do produto">
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo</label>
                                <input type="text" v-model="type" class="form-control" id="type" placeholder="Tipo do produto (Ex: Vestuário...)">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantidade</label>
                                <input type="number" v-model="quantity" class="form-control" id="quantity" placeholder="Quantidade em estoque...">
                            </div>
                            <button type="submit" @click.prevent="saveProduct" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Listagem dos Produtos</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Quant</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(product, index) in products.data" :key="product.id">
                                <th scope="row">{{index + 1}}</th>
                                <td>{{product.name}}</td>
                                <td>{{product.desc}}</td>
                                <td>{{product.type}}</td>
                                <td>{{product.quantity}}</td>
                                <td>Edit | Delete</td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination :data="products" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                products: {},
                name: '',
                desc: '',
                type: '',
                quantity: ''
            }
        },
        mounted() {
            this.getResults();
        },
        methods: {
            saveProduct(){
                axios.post('save_product',{
                    name: this.name,
                    desc: this.desc,
                    type: this.type,
                    quantity: this.quantity
                }).then(response => {
                    console.log(response);
                    this.getResults();
                });
            },
            getResults(page = 1) {
                axios.get('list_products?page=' + page)
                    .then(response => {
                        console.log(response.data);
                        this.products = response.data;
                    });
            }
        }
    }
</script>
