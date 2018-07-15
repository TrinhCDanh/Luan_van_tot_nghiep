<template id="may-list-status">
    <div class="row">
        <v-btn round color="error" class="pull-right" v-on:click="addItem()">
            <v-icon>add</v-icon>
            Thêm máy mới
        </v-btn>
        <br><br>
        <v-card>
            <v-card-title>
                <p class="display-1">Danh sách máy của {{ phongmay.tenphongmay }} </p>
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="maylist" :search="search" :loading="isLoading"
                          :rows-per-page-items='[15, 30, { text: "All", value: -1 }]'>
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="props">
                    <td class="text-xs-left">{{ props.item.sothutumay }}</td>
                    <td class="text-xs-left" v-bind:style="{color: props.item.tinhtrang == 0 ? 'black' : 'red'}">{{props.item.tinhtrang == 0 ? 'Tốt' : 'Gặp vấn đề' }}
                    </td>
                    <td class="justify-center layout px-0">
                        <v-btn icon class="mx-0" @click="goListTinhtrangmay(props.item.id, props.item.slug)">
                            <v-icon color="teal">visibility</v-icon>
                        </v-btn>
                        <v-btn icon class="mx-0" @click="deleteItem(props.item, props.item.id)"
                               v-if="props.index == maylist.length - 1">
                            <v-icon color="pink">delete</v-icon>
                        </v-btn>
                    </td>
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
                may: '',
                isLoading: false,
                search: '',
                phongmay_id: '',
                headers: [
                    {text: 'Tên/STT máy', value: 'sothutumay', sortable: false},
                    {text: 'Tình trạng máy', value: 'tinhtrang', sortable: false},
                    {text: 'Actions', value: 'name', sortable: false, align: 'center'}
                ],
                maylist: [],
                phongmay: []
            };
        },
        created: function () {
            this._fetchData();
        },
        methods: {
            _fetchData() {
                this.isLoading = true;
                let urlCurrent = window.location.href;
                this.phongmay_id = urlCurrent.slice(urlCurrent.lastIndexOf('may/') + 4);
                let url = location.origin + '/api/phongmay-have-may/' + this.phongmay_id;
                axios.get(url).then((rep) => {
                    this.phongmay = rep.data.phongmay[0];
                    setTimeout(() => {
                        this.isLoading = false;
                        this.maylist = rep.data.mayList;
                    }, 2000)
                })
            },
            addItem() {
                if(this.maylist.length == 0){
                    var tenphongmayArr = this.phongmay.tenphongmay.split('M');
                    var sothutumayNext = tenphongmayArr[0] + tenphongmayArr[1] + '_' + '01';
                    var slugNext = tenphongmayArr[0].toLowerCase()  + tenphongmayArr[1] + '-' + '01';
                }else{
                    var lastIndex = this.maylist.length - 1;
                    var sothutumayPrev = this.maylist[lastIndex].sothutumay;
                    console.log(sothutumayPrev);
                    var sothutumayNextArr = sothutumayPrev.split('_');
                    var test = parseInt(sothutumayNextArr[1]) + 1;
                    var sothutumayNext = sothutumayNextArr[0] + '_' + ('0' + test).slice(-2);
                    var slugNext = sothutumayNextArr[0].toLowerCase() + "-" + ('0' + test).slice(-2);
                }
                let newItem = {
                    sothutumay:sothutumayNext,
                    phongmay_id : this.phongmay_id,
                    tinhtrang: 0,
                    slug: slugNext
                }
                axios.post(location.origin + '/api/may',newItem).then((rep) =>{
                    this.maylist.push(newItem);
                })
            },

            deleteItem(item, id) {
                console.log(item.slug);
                Axios.delete(location.origin + '/api/may/' + item.slug).then((response) => {
                    const index = this.maylist.indexOf(item)
                    this.maylist.splice(index, 1)
                });
            },

            goListTinhtrangmay(may_id, may_slug) {
                this.$router.push({path: `/admin/may/tinhtrangmay/${may_slug}`});
            }

        },
        computed: {
            filteredmay: function () {
                if (this.maylist.length) {
                    return this.maylist;
                }
            },
        }
    }
</script>