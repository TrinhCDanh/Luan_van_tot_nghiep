<template id="add-lichtruc">
    <div>
        <h3>Thêm lịch trực cho kỹ thuật viên</h3>
        <v-form v-model="valid" v-on:submit.prevent="createlichtruc" method="POST">
            <v-layout row wrap>
                <v-flex xs12 sm4 md4>
                    <v-text-field v-model="lichtruc.hocky_id" label="Học kỳ" disabled></v-text-field>
                </v-flex>
                <v-spacer></v-spacer>
                <v-flex xs12 sm4 md4>
                    <v-text-field v-model="lichtruc.thu_id" label="Thứ" disabled></v-text-field>
                </v-flex><!-- :rules="emailRules" -->
                <v-spacer></v-spacer>
                <v-flex xs12 sm4 md4>
                    <v-text-field v-model="lichtruc.ca_id" label="Ca" disabled></v-text-field>
                </v-flex>
            </v-layout>

            <v-select
                    :items="kythuatvienList"
                    v-model="selectedKythuatvien"
                    label="Kỹ thuật viên"
                    single-line
                    item-text="name"
                    item-value="id"
                    return-object
                    persistent-hint
            ></v-select>

            <v-text-field v-model="lichtruc.ghichu" label="Ghi chú"></v-text-field>
            <v-btn v-bind:to="{name: 'LichtrucList'}">Back</v-btn>
            <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
        </v-form>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                urlCurrent: location.origin,
                lichtruc: {
                    hocky_id: '',
                    thu_id: '',
                    ca_id: '',
                    kythuatvien_id: '',
                    ghichu: ''
                },
                selectedKythuatvien: {},
                kythuatvienList: [],
                valid: false,
            }
        },
        created() {
            var _this = this;
            Axios.get(_this.urlCurrent + '/api/ca/' + this.$route.params.ca_id + '/edit').then((response) => {
                _this.lichtruc.ca_id = response.data.tenca;
            });

            Axios.get(_this.urlCurrent + '/api/thu/' + this.$route.params.thu_id + '/edit').then((response) => {
                _this.lichtruc.thu_id = response.data.tenthu;
            });

            Axios.get(_this.urlCurrent + '/api/hocky/' + this.$route.params.hocky_id + '/edit').then((response) => {
                _this.lichtruc.hocky_id = response.data.tenhocky + ' - ' + response.data.namhoc;
            });

            Axios.get(_this.urlCurrent + '/api/kythuatvien/').then((response) => {
                _this.kythuatvienList = response.data;
                // console.log(_this.kythuatvienList);
            });
        },
        methods: {
            createlichtruc: function () {
                //  var _this = this;
                //  var data = {
                //        hocky_id: _this.$route.params.hocky_id,
                //        thu_id: _this.$route.params.thu_id,
                //        ca_id: _this.$route.params.ca_id,
                //        kythuatvien_id: _this.selectedKythuatvien.id,
                //        ghichu: _this.lichtruc.ghichu
                //      }
                //   Axios.post(_this.urlCurrent + '/api/lichtruc', data).then((response) => {
                //      this.$router.push({name: 'LichtrucList'})
                //   });
                //   console.log(data);
                var _this = this;
                var data = {
                    hocky_id: _this.$route.params.hocky_id,
                    thu_id: _this.$route.params.thu_id,
                    ca_id: _this.$route.params.ca_id,
                    ghichu: _this.lichtruc.ghichu,
                    kythuatvien_id: _this.selectedKythuatvien.id,
                }
                axios.post(_this.urlCurrent + '/api/lichtruc', data).then((rep) => {
                    this.$router.push({name: 'LichtrucList'})
                })
            }
        },
        mounted() {
        }
    }
</script>