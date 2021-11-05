<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form v-on:submit.prevent="submitForm">
                    <h2 v-if="pageEdit == false">Adicionando um livro</h2>

                    <h2 v-if="pageEdit == true">Editando um livro</h2>

                    <input type="hidden" v-model="sendSubmit">

                    <input type="hidden" v-model="form.id">

                    <input type="text" v-model="form.name" placeholder="Nome">
                    <input type="text" v-model="form.author" placeholder="Author">

                    <select v-model="form.category" id="">
                        <option value="0">Selecione uma opção</option>

                        <option v-for="item in Categories" :value="item.id" :key="item.id">
                            {{ item.name }}
                        </option>
                    </select>

                    <input type="text" v-model="form.code" placeholder="Código">

                    <select v-model="form.type" id="">
                        <option value="1">Arquivo Digital</option>
                        <option value="2">Arquivo Físico</option>
                    </select>

                    <input type="file" name="myFiles" id="myFiles" @change="watchFiles($event.target.name, $event.target.files)">

                    <input type="text" v-model="form.length" placeholder="Tamanho">

                    <div class="block">
                        <a href="/" class="back">Voltar</a>

                        <input type="submit" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                form: {
                    author: '',
                    category: '',
                    code: '',
                    id: '',
                    length: '',
                    name: '',
                    archive: ''
                },
                lenght: 'KB',
                files: [],
                Categories: [],
                sendSubmit: 'create',
                pageEdit: false,
            }
        },
        methods:{
            submitForm : function(){
                const form = this.form;

                if( this.sendSubmit == 'create' ){
                    axios.post("/form", form)
                    .then(response => {
                        alert(response.data.message);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }else{
                    var id = this.form.id;

                    axios.put("/form/{id}", form)
                    .then(response => {
                        alert(response.data.message);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }
            },
            watchFiles(fieldName, fileList) {
                if (!fileList.length) return;
                this.files[0]=fileList[0];


                if( this.files[0].size / 1024 <= 1024 ){
                    this.lenght = 'KB';
                }else if(this.files[0].size / 1024 <= 1048576){
                    this.lenght = 'MB';
                }

                this.form.length = this.files[0].size / 1024 +" "+this.lenght;


                // console.log(this.$refs.myFiles.files);
                // this.files = this.$refs.myFiles.files
            }
        },
        mounted() {
            var id = window.location.pathname.split("/");
            id = id.reverse();

            if( id[0] != '' ){
                axios.get('/form/'+id[0]).then(response => {
                    // console.log(response);
                    this.form = response.data;

                    if( response.data.category != '' ){
                        this.pageEdit = true;
                        this.sendSubmit = 'update';
                    }
                });
            }else{
                this.sendSubmit = 'create';
            }

            axios.get('/categories').then(response => {
                this.Categories = response.data;
            });
        },
    }
</script>


<style lang="scss" scoped>
    form{
        display: flex;
        flex-direction: column;
        justify-content: center;

        input[type*="text"], input[type*="file"], select{
            border: 1px solid #ebebeb;
            padding: 10px 15px;
            margin-bottom: 10px;
        }

        .block{
            display: flex;
            justify-content: flex-start;
            flex-direction: row;
            margin-top: 20px;
        }

        input[type*="submit"], .back{
            padding: 15px;
            max-width: 150px;
            background: green;
            border: 0;
            color: #FFF;
            text-transform: uppercase;
            min-width: 200px;
        }

        .back{
            background: #ebebeb;
            display: flex;
            color: #000;
            text-decoration: none;
            text-align: center;
            margin: 0 20px 0 0;
            justify-content: center;
            align-items: center;
        }

    }
</style>
