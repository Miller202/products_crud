<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Cadastrar Produto</div>
                    <img class="figure-img" src="https://www.luiztools.com.br/wp-content/uploads/2017/07/CRUD.png">
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
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm" @click="editProduct(product.id)"
                                            data-toggle="modal" data-target="#exampleModal">
                                        Editar
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" @click="deleteProduct(product.id)">
                                        Remover
                                    </button>
                                    </td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination :data="products" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" v-model="edit_name" class="form-control" id="editname" placeholder="Nome do produto">
                            </div>
                            <div class="form-group">
                                <label for="desc">Descrição</label>
                                <input type="text" v-model="edit_desc" class="form-control" id="editdesc" placeholder="Descrição do produto">
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo</label>
                                <input type="text" v-model="edit_type" class="form-control" id="edittype" placeholder="Tipo do produto (Ex: Vestuário...)">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantidade</label>
                                <input type="number" v-model="edit_quantity" class="form-control" id="editquant" placeholder="Quantidade em estoque...">
                            </div>
                            <button type="submit" @click.prevent="updateProduct" data-dismiss="modal" class="btn btn-outline-success">Salvar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar</button>
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
                id: '',
                name: '',
                desc: '',
                type: '',
                quantity: '',
                edit_name: '',
                edit_desc: '',
                edit_type: '',
                edit_quantity: ''
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
                axios.get('list_products?page='+page)
                    .then(response => {
                        console.log(response.data);
                        this.products = response.data;
                    });
            },
            editProduct(id){
                axios.get('edit_product/'+id)
                    .then(response => {
                        this.id = response.data.id;
                        this.edit_name = response.data.name;
                        this.edit_desc = response.data.desc;
                        this.edit_type = response.data.type;
                        this.edit_quantity = response.data.quantity;
                    })
            },
            updateProduct(){
                axios.put('update_product',{
                    id: this.id,
                    name: this.edit_name,
                    desc: this.edit_desc,
                    type: this.edit_type,
                    quantity: this.edit_quantity
                }).then(response => {
                    console.log(response);
                    this.getResults();
                });
            },
            deleteProduct(id){
                axios.delete('delete_product/'+id)
                    .then(response => {
                        console.log(response);
                        this.getResults();
                    });
            }
        }
    }
</script>
