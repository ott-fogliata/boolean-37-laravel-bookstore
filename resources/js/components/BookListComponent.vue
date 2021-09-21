<template>
    <div class="container">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-for="n in totalPage" :key="n" v-on:click="changePage(n)" class="page-item"><a class="page-link" href="#">{{ n }}</a></li>
            </ul>
        </nav>
        <div class="row justify-content-center">
            <div v-for="book in books" :key="book.id" class="card col-md-3" style="width: 18rem;">
                <img class="card-img-top" :src="book.picture" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ book.title }}</h5>
                    <p class="card-text">{{ book.abstract }}</p>
                    <p class="card-text">{{ book.genere }}</p>
                    <a href="#" class="btn btn-primary">Buy</a>
                    <button v-on:click="deleteById(book.id)" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
            <SubComponent/>
        </div>

    </div>
</template>

<script>

    import SubComponent from './SubComponent.vue';

    export default {
        components: {
            'SubComponent': SubComponent
        },
        mounted() {
            this.getBooks();
        },
        data() {
            return {
                books: [],
                currentPage: 1,
                totalPage: 0
            }
        },
        methods: {
            getBooks() {
                axios.get(`/api/books?page=${this.currentPage}`).then((response) => {
                    this.books = response.data.data
                    this.totalPage = response.data.last_page
                });
            },
            changePage(nPage) {
                this.currentPage = nPage;
                this.getBooks();
            },
            deleteById(id) {
                axios.delete(`api/books/${id}`).then((response) => {
                   console.log(response);
                   // se tutto va a buon fine, richiamo l'api della lista dei libri
                   // per refreshare i data su vuejs
                   this.getBooks();
                });


            }
        }
    }
</script>

<style lang="sass" scoped>
 @import '../../sass/app-vuejs.scss'
</style>