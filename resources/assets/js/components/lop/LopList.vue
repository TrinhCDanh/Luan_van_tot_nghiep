<template id="lop-list">
    <div class="row">
        <v-btn class="pull-right" v-bind:to="{name: 'LopAdd'}">
            <!-- <router-link class="btn btn-xs btn-primary" v-bind:to="{name: 'HockyAdd'}"> -->
            <span class="glyphicon glyphicon-plus"></span>
            Thêm thông tin lớp mới
            <!-- </router-link> -->
        </v-btn>
        <v-card>
            <v-card-title>
                Nutrition
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="listLop"
                    :search="search"
            >
                <template slot="items" slot-scope="props">
                    <td class="text-xs-left">{{ props.item.id }}</td>
                    <td class="text-xs-left">{{ props.item.tenlop }}</td>
                    <td class="text-xs-left">{{ props.item.siso }}</td>
                    <v-btn icon class="mx-0" @click="editItem(props.item.id)">
                        <v-icon color="teal">edit</v-icon>
                    </v-btn>
                    <v-btn icon class="mx-0" @click="deleteItem(props.item,props.item.id)">
                        <v-icon color="pink">delete</v-icon>
                    </v-btn>
                </template>
                <v-alert slot="no-results" :value="true" color="error" icon="warning">
                    Your search for "{{ search }}" found no results.
                </v-alert>
            </v-data-table>
        </v-card>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                search: '',
                listLop: [],

                headers: [
                    {text: 'id', value: 'id'},
                    {text: 'Tên Lớp', value: 'tenlop'},
                    {text: 'Sỉ Số', value: 'siso'},
                    {text: 'Option', value: 'Option'}
                ],
            };
        },
        created() {
            let url = location.origin + '/api/lop';
            axios.get(url).then((rep) => {
                this.listLop = rep.data;
            });
        },
        methods: {
            deleteItem(item, id) {
                let url = window.location.origin + '/api/lop/' + id;
                axios.delete(url).then((rep) => {
                    const index = this.listLop.indexOf(item);
                    this.listLop.splice(index, 1);
                });
            },
            editItem(id){
                this.$router.push({path:'/admin/lop/edit/' + id})
            }
        },
        computed: {}
    }
</script>