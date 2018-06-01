<template id="monhoc-add">
    <div class="row">
        <v-form v-model="valid" v-on:submit.prevent="editeMonHoc" methods="POST">
            <v-text-field
                    v-model="monhoc.mamonhoc"
                    :rules="malRules"
                    label="Mã Môn Học"
                    required
            ></v-text-field>
            <v-text-field
                    v-model="monhoc.tenmonhoc"
                    :rules="tenlRules"
                    label="Tên Môn Học"
                    required
            ></v-text-field>
            <v-layout row wrap>
                <v-flex xs12 sm6 md6>
                    <v-menu
                            ref="menubatdau"
                            :close-on-content-click="false"
                            v-model="menubatdau"
                            :nudge-right="40"
                            :return-value.sync="date"
                            lazy
                            transition="scale-transition"
                            offset-y
                            full-width
                            min-width="290px"
                    >
                        <v-text-field
                                slot="activator"
                                v-model="monhoc.ngaybatdau"
                                label="Ngày bắt đầu"
                                prepend-icon="event"
                                readonly
                        ></v-text-field>
                        <v-date-picker v-model="monhoc.ngaybatdau"
                                       @input="$refs.menubatdau.save(monhoc.ngaybatdau)"></v-date-picker>

                    </v-menu>
                </v-flex>
                <v-flex xs12 sm6 md6>
                    <v-menu
                            ref="menuketthuc"
                            :close-on-content-click="false"
                            v-model="menuketthuc"
                            :nudge-right="40"
                            :return-value.sync="date"
                            lazy
                            transition="scale-transition"
                            offset-y
                            full-width
                            min-width="290px"
                    >
                        <v-text-field
                                slot="activator"
                                v-model="monhoc.ngayketthuc"
                                label="Ngày kết thúc"
                                prepend-icon="event"
                                readonly
                        ></v-text-field>
                        <v-date-picker v-model="monhoc.ngayketthuc"
                                       @input="$refs.menuketthuc.save(monhoc.ngayketthuc)"></v-date-picker>
                        ư
                    </v-menu>
                </v-flex>
            </v-layout>
            <v-btn v-bind:to="{name: 'MonhocList'}">Back</v-btn>
            <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
        </v-form>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                valid: false,
                monhoc: {mamonhoc: '', tenmonhoc: '', ngaybatdau: '', ngayketthuc: ''},
                date: null,
                menu: false,
                modal: false,
                menubatdau: false,
                menuketthuc: false,
                mamonhoc: '',
                malRules: [
                    v => !!v || 'Name is required',
                ],
                tenmonhoc: '',
                tenlRules: [
                    v => !!v || 'E-mail is required',
                ]
            };
        },
        created() {
                let urlCurrent = window.location.href;
              let monhoc_id = urlCurrent.slice(urlCurrent.lastIndexOf('edit/') + 5 , urlCurrent.length);
              let uri = location.origin+'/api/monhoc/'+ monhoc_id + '/edit';
              Axios.get(uri).then((response) => {
                this.monhoc = response.data;
              });
        },
        methods: {
            editeMonHoc: function () {
                let url = location.origin + '/api/monhoc/' + this.monhoc.id;
                console.log(url);
                axios.patch(url, this.monhoc).then((rep) => {
                    this.$router.push({name: 'MonhocList'})
                    console.log(rep.data);
                });
            }
        },
        computed: {}
    }
</script>