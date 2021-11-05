<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="buttonsAdd">
                    <a href="form/">Adicionar</a>
                </div>

                <div class="search">
                    <form role="search" action="/?" id="" method="get">
                        <select v-model="searchArr.type" @change="searchFilter" id="">
                            <option value="1">Arquivo Digital</option>
                            <option value="2">Arquivo Físico</option>
                        </select>

                        <select v-model="searchArr.category" @change="searchFilter" id="">
                            <option value="0">Selecione uma opção</option>

                            <option v-for="item in Categories" :value="item.id" :key="item.id">
                                {{ item.name }}
                            </option>
                        </select>

                        <input type="text" id="" placeholder="Procure um livro..." autocomplete="off" v-model="search">

                        <input type="date" @change="searchFilter" id="" autocomplete="off" v-model="searchArr.dataCadastro">
                    </form>
                </div>

                <div class="row listIndex">
                    <ul class="item">
                        <li v-for="(homePost, index) in filteredList" :key="index">
                            <a href="">{{homePost.id}}</a>
                            <a href="">{{homePost.name}}</a>
                            <a href="">{{homePost.author}}</a>
                            <a href="">{{homePost.updated_at}}</a>
                            <a href="/form/edit/" @click.prevent="editBook(homePost.id)" class="editar">Editar</a>
                            <a href="" @click.prevent="deleteBook(homePost.id)" class="excluir">Excluir</a>
                        </li>
                    </ul>
                </div>

                <div class="paginate" style="">
                    <div class="item" v-for="(paginate, index) in paginate" :key="index">
                        <a aria-current="page" :class="{'current': paginate.active == true, 'inactive': paginate.local == false}" class="page-numbers" @click="refreshPaginate(paginate)">
                            {{paginate.label}}
                        </a>
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
                homePosts: [],
                paginate: [],
                searchBook: [],
                Categories: [],
                search: '',
                searchArr: {
                    type: 1,
                    category: 0,
                    dataCadastro: '2021-11-05',
                }
            }
        },
        mounted() {
            axios.get('/getBooks').then(response => {
                this.homePosts = response.data.data;

                console.log(response.data)

                this.paginate = response.data.links;
            });

            axios.get('/categories').then(response => {
                this.Categories = response.data;
            });
        },
        methods: {
            refreshPaginate(data) {
                if( data.url != null ){
                    const paged = data.url.split('?');

                    axios.get('/getBooks?'+paged[1]).then(response => {
                        console.log(response.data);
                        this.homePosts = response.data.data;
                        this.paginate = response.data.links;
                    });
                }else{
                    alert('Página não encontrada!');
                }

            },
            deleteBook(id){
                if( confirm('Realmente deseja excluir esse livro?') ){
                    axios.delete('/getBooks/'+id).then(response => {
                        axios.get('/getBooks').then(response => {
                            this.homePosts = response.data.data;
                            this.paginate = response.data.links;
                        });
                    });
                }
            },
            editBook(id){
                window.location.href = '/form/edit/'+id;
            },
            searchFilter(){
                const form = this.searchArr;

                axios.post("/filtered", form)
                .then(response => {
                    console.log(response.data);
                    this.homePosts = response.data.data;
                    console.log(this.homePosts);
                })
                .catch((error) => {
                    console.log(error);
                });

            }
        },
		computed: {
			filteredList() {
				if(this.search === '') return this.homePosts
				return this.homePosts.filter(entry => {
					return entry.name.toLowerCase().includes(this.search.toLowerCase())
				})
			}
		}
    }
</script>

<style lang="scss" scoped>
    .buttonsAdd{
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        margin-bottom: 50px;

        a{
            padding: 15px;
            background: green;
            color: #FFF;
            border-radius: 5px;
            text-transform: uppercase;
            text-decoration: none;
        }
    }

    .search{
        form{
            display: flex;
            justify-content: flex-end;

            input, select{
                background: #ebebeb;
                border: 0;
                width: 50%;
                padding: 15px;
                color: #000;
                margin-bottom: 15px;
                outline: none;
            }

            input{
                appearance: none;
                margin-left: 30px;
            }

            select{
                &:nth-child(2){
                    margin-left: 30px;
                }
            }
        }
    }

    .listIndex{
        display: flex;
        flex-direction: column;
        margin-bottom: 50px;

        .item{
            display: flex;
            flex-direction: column;
            padding: 0 15px;
            flex: 1;

            li{
                display: flex;
                justify-content: space-between;
                padding: 10px;

                &:nth-child(odd){
                    background: #c1c1c1;

                    a{
                        &.editar{
                            color: black;
                        }
                    }
                }

                a{
                    cursor: pointer;
                    text-decoration: none;

                    &.editar{
                        color: darkgray;
                    }

                    &.excluir{
                        color: red;
                    }
                }
            }
        }
    }

    .paginate{
        display: flex;
        flex-direction: row;
        padding: 0;
        flex: 1;

        .item{
            display: flex;
            flex-direction: row;
            padding: 0;

            a{
                margin-right: 10px;
                cursor: pointer;
                text-decoration: none;

                &.current, &:hover{
                    color: red;
                }
            }
        }
    }
</style>
